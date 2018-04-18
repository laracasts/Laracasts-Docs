<?php

namespace App\Http\Controllers;

use Facades\App\Documentation;

class DocumentationController extends Controller
{
    /**
     * Show the documentation page.
     *
     * @param string $version
     * @param string $page
     * @return mixed
     */
    public function show($version, $page = '')
    {
        if (! $this->validVersion($version)) {
            return redirect('docs/' . DEFAULT_VERSION . '/' . $version);
        }

        try {
            return view('docs', [
                'content' => Documentation::get($version, $page)
            ]);
        } catch (\Exception $e) {
            abort(404, 'The requested documentation was not found.');
        }
    }

    /**
     * Determine if the given version number is valid.
     *
     * @param  string $version
     * @return bool
     */
    protected function validVersion($version)
    {
        return in_array($version, Documentation::versions());
    }
}
