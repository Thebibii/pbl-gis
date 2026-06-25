import { defineConfig } from "vite";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
  plugins: [tailwindcss()],
  publicDir: false,
  build: {
    outDir: "public/build",
    emptyOutDir: true,
    manifest: true,
    rollupOptions: {
      input: "resources/js/app.js", // <-- ubah ini
    },
  },
  server: {
    origin: "http://localhost:5173",
    cors: true,
    watch: {
      ignored: ["**/vendor/**", "**/writable/**", "**/node_modules/**"],
    },
    warmup: {
      clientFiles: ["./resources/css/app.css", "./resources/js/app.js"],
    },
  },
});
