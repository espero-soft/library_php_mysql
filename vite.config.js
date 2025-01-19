import { defineConfig } from 'vite'
    import php from 'vite-plugin-php'

    export default defineConfig({
      plugins: [php()],
      build: {
        outDir: 'dist'
      }
    })
