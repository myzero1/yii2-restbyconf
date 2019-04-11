window.onload = function() {
  // Begin Swagger UI call region
  const ui = SwaggerUIBundle({
    // url: "https://petstore.swagger.io/v2/swagger.json",
    // url: "/swagger.json",
    url: $('#swagger-json-uri').text(),
    dom_id: '#swagger-content',
    deepLinking: true,
    presets: [
      SwaggerUIBundle.presets.apis,
      SwaggerUIStandalonePreset
    ],
    plugins: [
      SwaggerUIBundle.plugins.DownloadUrl
    ],
    layout: "StandaloneLayout"
  })
  // End Swagger UI call region

  window.ui = ui
}