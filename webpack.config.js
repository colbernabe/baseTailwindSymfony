const Encore = require('@symfony/webpack-encore');

// Configuración manual del entorno de tiempo de ejecución si aún no está configurado por el comando "encore".
// Es útil cuando se utilizan herramientas que dependen del archivo webpack.config.js.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // directorio donde se almacenarán los activos compilados
    .setOutputPath('public/build/')
    // ruta pública utilizada por el servidor web para acceder al directorio de salida
    .setPublicPath('/build')
    // solo necesario para CDNs o implementación en subdirectorios
    // .setManifestKeyPrefix('build/')

    .enablePostCssLoader()

    /*
     * CONFIGURACIÓN DE ENTRADA
     *
     * Cada entrada generará un archivo JavaScript (por ejemplo, app.js)
     * y un archivo CSS (por ejemplo, app.css) si su JavaScript importa CSS.
     */
    .addEntry('app', './assets/app.js')

    // Cuando se habilita, Webpack "divide" sus archivos en piezas más pequeñas para una mayor optimización.
    .splitEntryChunks()

    // requerirá una etiqueta de script adicional para runtime.js
    // pero probablemente quieras esto, a menos que estés construyendo una aplicación de una sola página
    .enableSingleRuntimeChunk()

    /*
     * CONFIGURACIÓN DE CARACTERÍSTICAS
     *
     * Habilite y configure otras características a continuación. Para obtener una lista completa
     * de características, consulte:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // habilita nombres de archivo con hash (por ejemplo, app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // Configura Babel
    // .configureBabel((config) => {
    //     config.plugins.push('@babel/a-babel-plugin');
    // })

    // habilita y configura polifills de @babel/preset-env
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = '3.23';
    })

    // habilita el soporte de Sass/SCSS
    // .enableSassLoader()

    // descomentar si se utiliza TypeScript
    // .enableTypeScriptLoader()

    // descomentar si se utiliza React
    // .enableReactPreset()

    // descomentar para obtener atributos de integridad "..." en sus etiquetas de script y enlace
    // requiere WebpackEncoreBundle 1.4 o superior
    // .enableIntegrityHashes(Encore.isProduction())

    // descomentar si tiene problemas con un complemento de jQuery
    // .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
