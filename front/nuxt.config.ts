// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: true },
  modules: [
    '@pinia/nuxt',
    '@pinia-plugin-persistedstate/nuxt',
    '@vesp/nuxt-fontawesome',
    'nuxt-socket-io',
    'nuxt-icon',
    
  ],
 
  css: [
    '@fortawesome/fontawesome-svg-core/styles.css'
  ],
  fontawesome: {
    icons: {
      solid: ['dollar-sign', 'cog', 'circle', 'check', 'calendar'],
      regular: ['user']
    }
  },
  app: {
    pageTransition: { name: 'page', mode: 'out-in' }
    
  },
  io: {
    sockets: [
      {
        name: 'main',
        url: 'http://localhost:3001' // URL del servidor de sockets
      }
    ],
  },
  

})
