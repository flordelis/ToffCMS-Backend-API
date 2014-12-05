<?php

class PageRepository {

	/**
	 * Get all of the pages w/ author.
	 * @return [Page]
	 */
	public function getWithAuthor()
	{
		return Page::with('author')
			->get();
	}

	/**
	 * Grab the pages by slug and language that
	 * are public.
	 * @param  string $slug
	 * @param  string $language
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
	 * Update a page.
	 * @param  integer $id
	 * @param  array $input
	 * @return Page
	 */
	public function update($id, array $input)
	{
		$page = Page::findOrFail($id);
		Page::validateOrFail($input, 'update');

		$page->save($input);
		return $page;
	}

	/**
	 * Create a new page.
	 * @param  array $input
	 * @return Page
	 */
	public function create($input)
	{
		Page::validateOrFail($input);

		$page = new Page($input);
		$page->author_id = User::getCurrent()->id;
		$page->save();

		return $page;
	}

	/**
	 * Delete the page
	 * @param  integer $id
	 * @return boolean
	 */
	public function delete($id)
	{
		return Page::destroy($id);
	}
}
