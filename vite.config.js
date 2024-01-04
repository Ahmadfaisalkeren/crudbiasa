import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

// Middleware to enable CORS
const corsMiddleware = () => {
  return (req, res, next) => {
    res.setHeader('Access-Control-Allow-Origin', '*');
    res.setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    res.setHeader('Access-Control-Allow-Headers', '*');
    next();
  };
};

export default defineConfig({
  server: {
    middleware: corsMiddleware(),
  },
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
  ],
});
