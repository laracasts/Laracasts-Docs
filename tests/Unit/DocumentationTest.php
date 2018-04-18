<?php

namespace Tests\Unit;

use App\Documentation;
use Tests\TestCase;

class DocumentationTest extends TestCase
{
    /** @test */
    public function it_gets_the_documentation_page_for_a_given_version()
    {
        $content = (new Documentation)->get('1.0', 'stub', base_path('tests/helpers/stubs'));

        $this->assertContains('<p>Here is the documentation stub.</p>', $content);
    }

    /** @test */
    public function it_throws_an_exception_if_the_requested_markdown_file_does_not_exist()
    {
        $this->expectException(\Exception::class);

        (new Documentation)->get('1.0', 'example');
    }
}
