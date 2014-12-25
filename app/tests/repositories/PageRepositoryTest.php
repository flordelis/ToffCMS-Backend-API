<?php

class PageRepositoryTest extends TestCase
{
    protected $pageRepository;
    protected $firstPage;

    /**
     * Set the seeds
     */
    public function setUp()
    {
        parent::setUp();

        Eloquent::unguard();
        $this->seed('UserTableSeeder');
        $this->seed('PageTableSeeder');

        $this->pageRepository = new PageRepository(new Page());
        $this->firstPage = $this->pageRepository->find(1);

        $this->be(User::find(1));
    }

    /**
     * @expectedException ValidationException
     */
    public function testCreateWithDuplicateSlug()
    {
        $array = $this->firstPage->toArray();
        unset($array['id']);

        $this->pageRepository->create($array);
    }

    /**
     * @expectedException ValidationException
     */
    public function testUpdateWithDuplicateSlug()
    {
        $array = $this->firstPage->toArray();

        $this->pageRepository->update($array['id'], $array);
    }

    public function testCreate()
    {
        $array = $this->firstPage->toArray();
        unset($array['id']);

        $array['language'] = 'lv';

        $new = $this->pageRepository->create($array);
        $this->assertTrue($new !== $this->firstPage);
    }
}
