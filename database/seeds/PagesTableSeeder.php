<?php

use Illuminate\Database\Seeder;
use App\Models\Page;
class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages_list = array(
            array(
                'title' => 'About Us',
                'slug' => \Str::slug('About Us'),
                'summary' => 'This is About us page.',
                'status' =>'active'
            ),
            array(
                'title' => 'Privacy Policy',
                'slug' => \Str::slug('Privacy Policy'),
                'summary' => 'This is About us page.',
                'status' =>'active'
            ),
            array(
                'title' => 'Terms and Condition',
                'slug' => \Str::slug('Terms and Condition'),
                'summary' => 'This is About us page.',
                'status' =>'active'
            ),
            array(
                'title' => 'Help and FAQ',
                'slug' => \Str::slug('Help and FAQ'),
                'summary' => 'This is About us page.',
                'status' =>'active'
            )

        );
        foreach ($pages_list as $page_item){
            $page = new Page();
            if($page->where('slug',$page_item['slug'])->count() <= 0){
                $page->fill($page_item);
                $page->save();
            }
        }
    }
}
