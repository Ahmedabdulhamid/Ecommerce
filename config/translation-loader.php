<?php

return [
    /*
     * The project currently uses file-based translations from lang/.
     * Disabling DB loaders prevents the package from probing for the
     * non-existent language_lines table on every request.
     */
    'translation_loaders' => [],

    'model' => Spatie\TranslationLoader\LanguageLine::class,

    'translation_manager' => Spatie\TranslationLoader\TranslationLoaderManager::class,
];
