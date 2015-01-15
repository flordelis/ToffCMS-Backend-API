<?php

/**
 * Page repository.
 */
class PageRepository extends Repository
{
    /**
     * Constructor.
     *
     * @param Page $model Page model.
     */
    public function __construct(Page $model)
    {
        $this->model = $model;
    }

    /**
     * Get all of the pages w/ author.
     *
     * @return [Page]
     */
    public function getWithAuthor()
    {
        return $this->getModel()
            ->with('author')
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

        return $this->getModel()
            ->where('slug', $slug)
            ->where('status', 'live')
            ->where('language', $language)
            ->with('author')
            ->firstOrFail();
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
        $this->getModel()->validateOrFail($input);

        $page = $this->getModel($input);
        $page->author_id = Auth::user()->id;
        $page->save();

        return $page;
    }
}
