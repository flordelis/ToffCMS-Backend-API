<?php

class PageTableSeeder extends Seeder {

	public function run()
	{
		DB::table('pages')->delete();

		Page::create(array(
			'title' => 'Lorem ipsum dolor amet sit',
			'slug' => 'lorem-ipsum-dolor-amet-sit',
			'body' => 'Lai veiktu mācību uzdevumu izpildi, šovakar vairākas militāro transporta līdzekļu kolonnas virzīsies no Ainažu robežkontroles punkta līdz Ādažu poligonam pa Tallinas šoseju. Lai mazinātu militāro kolonnu pārvietošanās radītos apgrūtinājumus pārējiem autovadītājiem, katra kolonna tiks apstādināta autoceļa 42.kilometrā, ar mērķi atjaunot ikdienas satiksmes plūsmu.

Savukārt pēc mācību uzdevuma izpildes 28.aprīlī agri no rīta vairākas kolonnas dosies atpakaļ.

Nacionālie bruņotie spēki (NBS) atvainojas par sagādātajām neērtībām, lūdz ar izpratni izturēties pret iespējamajiem satiksmes kustības īslaicīgiem apgrūtinājumiem, kā arī ievērot ceļu satiksmes noteikumus un Militārās policijas satiksmes regulētāju norādījumus.',
			'status' => 'live',
			'author_id' => User::first()->id
		));

		Page::create(array(
			'title' => 'Test',
			'slug' => 'test',
			'body' => 'Lai veiktu mācību uzdevumu izpildi, šovakar vairākas militāro transporta līdzekļu kolonnas virzīsies no Ainažu robežkontroles punkta līdz Ādažu poligonam pa Tallinas šoseju. Lai mazinātu militāro kolonnu pārvietošanās radītos apgrūtinājumus pārējiem autovadītājiem, katra kolonna tiks apstādināta autoceļa 42.kilometrā, ar mērķi atjaunot ikdienas satiksmes plūsmu.',
			'status' => 'live',
			'author_id' => User::first()->id
		));
	}

}
