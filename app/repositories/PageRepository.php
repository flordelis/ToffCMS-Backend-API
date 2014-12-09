<?php

/**
 * Page repository.
 */
class PageRepository extends Repository
{
    protected static $model = 'Page';

    /**
     * Get all of the pages w/ author.
     *
     * @return [Page]
     */
    public function getWithAuthor()
    {
        return Page::with('author')
            ->get();
    }

    /**
     * Grab the pages by slug and language that are public.
     *
     * @param string $slug     Slug of the page.
     * @param string $language Language of the page.
     *
     * @return Page
     */
    public function getForShow($slug, $language = 'en')
    {
        if ($language === null) {
            $language = 'en';
        }

        return Page::where('slug', $slug)
            ->where('status', 'live')
            ->where('language', $language)
            ->with('author')
            ->take(1)
            ->get();
    }

    /**
     * Create a new page.
     *
     * @param array $input User input.
     *
     * @return Page
     */
    public function create(array $input)
    {
        Page::validateOrFail($input);

        $page = new Page($input);
        $page->author_id = Auth::user()->id;
        $page->save();

        return $page;
    }
}
