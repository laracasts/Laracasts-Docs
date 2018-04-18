<?php

namespace App;

use Exception;
use Illuminate\Support\Facades\File;
use Parsedown;

class Documentation
{
    /**
     * Fetch a list of valid documentation versions.
     */
    public static function versions()
    {
        return [1.0, 1.1];
    }

    /**
     * Get the compiled Markdown file contents.
     *
     * @param  string      $version
     * @param  string      $page
     * @param  string|null $basePath
     * @return mixed
     * @throws \Exception
     */
    public function get($version, $page, $basePath = null)
    {
        if (File::exists($page = $this->markdownPath($version, $page, $basePath))) {
            return $this->replaceVersion($version, (new Parsedown)->text(File::get($page)));
        }

        throw new Exception('The requested documentation page was not found.');
    }

    /**
     * Determine the markdown file path.
     *
     * @param  string $version
     * @param  string $page
     * @param  null   $basePath
     * @return string
     */
    public function markdownPath($version, $page, $basePath = null)
    {
        $basePath = $basePath ?? resource_path();

        return $basePath . '/docs/' . $version . '/' . $page . '.md';
    }

    /**
     * Replace all {{version}} instances with the current documentation version.
     *
     * @param  string $version
     * @param  string $content
     * @return mixed
     */
    protected function replaceVersion($version, $content)
    {
        return str_replace('{{version}}', $version, $content);
    }
}
