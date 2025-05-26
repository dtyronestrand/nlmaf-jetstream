<script setup lang="ts">

import Head from "../Components/Theme/Head.vue";

import { defineAsyncComponent, onMounted, onUnmounted, ref } from "vue";
import Default from "../Layouts/Default.vue";
const canvasRef = ref<HTMLCanvasElement | null>(null);


interface Props {
    item: Model.Page;
}
const BlockCommonHeading = defineAsyncComponent(() => import("../Components/Theme/Block/Common/Heading.vue"));
const BlockCommonHero = defineAsyncComponent(() => import("../Components/Theme/Block/Common/Hero.vue")); defineProps<Props>();

// WebGL Shader and Handler
const fragmentShaderSource = `#version 300 es
precision highp float;
uniform float time;
uniform vec2 vp;
in vec2 uv;
out vec4 fragColor;
float rand(vec2 p) {
    return fract(sin(dot(p.xy, vec2(1., 300.))) * 43758.5453123);
}
float noise(vec2 p) {
    vec2 i = floor(p);
    vec2 f = fract(p);

    float a = rand(i);
    float b = rand(i + vec2(1.0, 0.0));
    float c = rand(i + vec2(0.0, 1.0));
    float d = rand(i + vec2(1.0, 1.0));

    vec2 u = f * f * (3.0 - 2.0 * f);

    return mix(a, b, u.x) +
            (c - a)* u.y * (1.0 - u.x) +
            (d - b) * u.x * u.y;
}

#define OCTAVES 5
float fbm(vec2 p) {

    float value = 0.;
    float amplitude = .4;
    float frequency = 0.;


    for (int i = 0; i < OCTAVES; i++) {
        value += amplitude * noise(p);
        p *= 2.;
        amplitude *= .4;
    }
    return value;
}

void main() {
    vec2 p = uv.xy;
    p.x *= vp.x / vp.y; 

    float gradient = mix(p.y*.6 + .1, p.y*1.2 + .9, fbm(p));
    float speed = 0.2;
    float details = 7.;
    float force = .9;
    float shift = .5;
   
    vec2 fast = vec2(p.x, p.y - time*speed) * details;
    float ns_a = fbm(fast);
    float ns_b = force * fbm(fast + ns_a + time) - shift;    
    float nns = force * fbm(vec2(ns_a, ns_b));
    float ins = fbm(vec2(ns_b, ns_a));

    vec3 c1 = mix(vec3(.9, .5, .3), vec3(.5, .0, .0), ins + shift);

    fragColor = vec4(c1 + vec3(ins - gradient), 1.0);
}
`;

class WebGLHandler {
    private cn: HTMLCanvasElement;
    private gl: WebGL2RenderingContext;
    private startTime: number;
    private program: WebGLProgram | null;
    private timeLocation: WebGLUniformLocation | null = null;
    private resolutionLocation: WebGLUniformLocation | null = null;
    private animationFrameId: number | null = null;

vertexShaderSource = `#version 300 es
    precision mediump float;
    const vec2 positions[6] = vec2[](
        vec2(1.0, -1.0),
        vec2(-1.0, 1.0),
        vec2(-1.0, -1.0),
        vec2(-1.0, 1.0),
        vec2(1.0, -1.0),
        vec2(1.0, 1.0)
    );
    out vec2 uv;
    void main() {
        uv = positions[gl_VertexID];
        gl_Position = vec4(positions[gl_VertexID], 0.0, 1.0);
    }`;

    constructor(canvas: HTMLCanvasElement, fragmentShaderSrc: string) {
        this.cn = canvas;
        this.gl = canvas.getContext('webgl2')!; // Add non-null assertion
        this.startTime = Date.now();

        this.resize();
        window.addEventListener('resize', this.resize);

        this.program = this.gl.createProgram();
        if (!this.program) {
            console.error("Failed to create WebGL program.");
            return;
        }
        this.compileShader(this.vertexShaderSource, this.gl.VERTEX_SHADER);
        this.compileShader(fragmentShaderSrc, this.gl.FRAGMENT_SHADER);
        this.gl.linkProgram(this.program);

        if (!this.gl.getProgramParameter(this.program, this.gl.LINK_STATUS)) {
            console.error('Unable to initialize the shader program: ' + this.gl.getProgramInfoLog(this.program));
            this.gl.deleteProgram(this.program);
            this.program = null;
            return;
        }

        this.gl.useProgram(this.program);

        this.timeLocation = this.gl.getUniformLocation(this.program, 'time');
        this.resolutionLocation = this.gl.getUniformLocation(this.program, 'vp');

        this.render();
    }

    resize = () => { // Make resize an arrow function to preserve `this`
        this.cn.width = window.innerWidth;
        this.cn.height = window.innerHeight;
        this.gl.viewport(0, 0, this.cn.width, this.cn.height);
    }

    compileShader(source: string, type: number) {
        if (!this.program) return null;
        const shader = this.gl.createShader(type);
        if (!shader) {
            console.error("Failed to create shader.");
            return null;
        }
        this.gl.shaderSource(shader, source);
        this.gl.compileShader(shader);
        if (!this.gl.getShaderParameter(shader, this.gl.COMPILE_STATUS)) {
            console.error('An error occurred compiling the shaders: ' + this.gl.getShaderInfoLog(shader));
            this.gl.deleteShader(shader);
            return null;
        }
        this.gl.attachShader(this.program, shader);
        return shader; // Return shader for potential cleanup if attach fails, though typically not needed here
    }

    render = () => {
        if (!this.program || !this.timeLocation || !this.resolutionLocation) return;

        this.gl.uniform1f(this.timeLocation, (Date.now() - this.startTime) / 1000);
        this.gl.uniform2fv(this.resolutionLocation, [this.cn.width, this.cn.height]);
        this.gl.drawArrays(this.gl.TRIANGLES, 0, 6);
        this.animationFrameId = window.requestAnimationFrame(this.render);
    }

    cleanup = () => {
        window.removeEventListener('resize', this.resize);
        if (this.animationFrameId) {
            window.cancelAnimationFrame(this.animationFrameId);
            this.animationFrameId = null; // Clear the animation frame ID
        }
        if (this.program) {
            // Detach and delete shaders if they were stored
            // For simplicity, just deleting the program which also detaches shaders
            this.gl.deleteProgram(this.program);
            this.program = null; // Clear the program reference
        }
        // Potentially delete buffers and textures if any were created

        // Hide the canvas element so it doesn't persist on other pages
        if (this.cn) {
            this.cn.style.display = 'none';
        }
    }
}

let webGLInstance: WebGLHandler | null = null;

onMounted(() => {
    if (canvasRef.value) {
        // Ensure the canvas takes up the full viewport for this effect
        canvasRef.value.style.display = "block";
        canvasRef.value.style.position = "fixed"; // Or 'absolute' depending on layout
        canvasRef.value.style.top = "0";
        canvasRef.value.style.left = "0";
        canvasRef.value.style.width = "100vw";
        canvasRef.value.style.height = "100vh";
        canvasRef.value.style.zIndex = "-1"; // To place it behind other content

        webGLInstance = new WebGLHandler(canvasRef.value, fragmentShaderSource);
    }
});

onUnmounted(() => {
    if (webGLInstance) {
        webGLInstance.cleanup();
        webGLInstance = null; // Clear the instance reference
    }
});

</script>

<template>
   
    <Head :item="item"></Head>
    <Default>
    <canvas ref="canvasRef" class="webgl-canvas"></canvas>

        <div
    v-if="item?.blocks && Array.isArray(item.blocks) && item.blocks.length > 0"
    class="mx-auto mt-20 w-full max-w-6xl"
  >
    <div
      v-for="(block, index) in item.blocks"
      :key="index"
    >
      <BlockCommonHeading
        v-if="block.type == 'common-heading'"
        :block="block"
      ></BlockCommonHeading>
        <BlockCommonHero
            v-if="block.type == 'common-hero'"
            :block="block"></BlockCommonHero>
    </div>
  </div>
  
</Default>
</template>
<style scoped>
/* You might want to ensure your other content is visible above the canvas */
.webgl-canvas {
    /* Styles are now applied inline in onMounted for dynamic sizing,
       but you can keep some base styles or fallbacks here if needed. */
}
</style>