<?php

use Illuminate\Database\Seeder;
use MPOproperty\Mposuccess\Models\Country;
use MPOproperty\Mposuccess\Models\Program;
use MPOproperty\Mposuccess\Models\News;
use MPOproperty\Mposuccess\Models\Product;
use MPOproperty\Mposuccess\Models\TreeSetting;

class TablesSeeder extends Seeder {

    public function run()
    {
        /*
         * Create countries
         */
        Country::create([
            'name'  => 'Беларусь',
            'flag'  => 'by',
            'code'  => '375',
        ]);

        Country::create([
            'name'  => 'Российская федерация',
            'flag'  => 'ru',
            'code'  => '70',
        ]);

        Country::create([
            'name'  => 'Украина',
            'flag'  => 'ua',
            'code'  => '380',
        ]);

        Country::create([
            'name'  => 'Казакстан',
            'flag'  => 'kz',
            'code'  => '70',
        ]);

        Country::create([
            'name'  => 'Азербайджан',
            'flag'  => 'az',
            'code'  => '994',
        ]);

        Country::create([
            'name'  => 'Армения',
            'flag'  => 'am',
            'code'  => '374',
        ]);

        Country::create([
            'name'  => 'Грузия',
            'flag'  => 'ge',
            'code'  => '995',
        ]);

        Country::create([
            'name'  => 'Киргизия',
            'flag'  => 'kg',
            'code'  => '996',
        ]);

        Country::create([
            'name'  => 'Латвия',
            'flag'  => 'lv',
            'code'  => '371',
        ]);

        Country::create([
            'name'  => 'Литва',
            'flag'  => 'lt',
            'code'  => '370',
        ]);

        Country::create([
            'name'  => 'Молдова',
            'flag'  => 'md',
            'code'  => '373',
        ]);

        Country::create([
            'name'  => 'Туркмения',
            'flag'  => 'tm',
            'code'  => '993',
        ]);

        Country::create([
            'name'  => 'Узбекистан',
            'flag'  => 'uz',
            'code'  => '998',
        ]);

        Country::create([
            'name'  => 'Эстония',
            'flag'  => 'ee',
            'code'  => '372',
        ]);

        /*
         * Create programs
         */
        Program::create([
            'name'          => 'Покупка продукта',
            'description'   => 'Краткое описание программы "Покупка продукта"',
        ]);

        Program::create([
            'name'          => 'Вступление в МПО',
            'description'   => 'Краткое описание программы "Вступление в МПО"',
        ]);

        /*
         * Create private news
         */
        News::create([
            'name'      => 'Odio dignissimos ducimus',
            'preview'   => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident',
            'content'   => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culp orem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.',
            'display'   => 1,
            'type'      => config('mposuccess.news_type_private'),
        ]);

        News::create([
            'name'      => 'Sint occaecati cupiditat',
            'preview'   => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident',
            'content'   => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culp orem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.',
            'display'   => 1,
            'type'      => config('mposuccess.news_type_private'),
        ]);

        News::create([
            'name'      => 'Accusamus et iusto odio',
            'preview'   => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident',
            'content'   => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culp orem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.',
            'display'   => 1,
            'type'      => config('mposuccess.news_type_private'),
        ]);

        News::create([
            'name'      => 'Vero eos et accusam',
            'preview'   => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident',
            'content'   => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culp orem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.',
            'display'   => 1,
            'type'      => config('mposuccess.news_type_private'),
        ]);

        News::create([
            'name'      => 'Google Glass Technology..',
            'preview'   => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident',
            'content'   => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culp orem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.',
            'display'   => 1,
            'type'      => config('mposuccess.news_type_private'),
        ]);

        /*
        * Create company news
        */
        News::create([
            'name'      => 'News company 1',
            'preview'   => 'News company 1 News company 1 News company 1 News company 1 News company 1 News company 1 News company 1 News company 1 News company 1 News company 1 News company 1 News company 1',
            'content'   => '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culp orem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p><blockquote class="hero"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit posuere erat a ante.</p><small>Someone famous <cite title="Source Title">Source Title</cite></small></blockquote><p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique dimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p>',
            'display'   => 1,
            'type'      => config('mposuccess.news_type_company'),
            'img'       => 'news-test-1.jpg',
        ]);

        News::create([
            'name'      => 'News company 2',
            'preview'   => 'News company 2 News company 2 News company 2 News company 2 News company 2 News company 2 News company 2 News company 2 News company ',
            'content'   => '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culp orem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p><blockquote class="hero"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit posuere erat a ante.</p><small>Someone famous <cite title="Source Title">Source Title</cite></small></blockquote><p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique dimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p>',
            'display'   => 1,
            'type'      => config('mposuccess.news_type_company'),
            'img'       => 'news-test-2.jpg',
        ]);

        News::create([
            'name'      => 'News company 3',
            'preview'   => 'News company 3 News company 3 News company 3 News company 3 News company 3 News company 3 News company 3 News company 3 News company 3',
            'content'   => '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culp orem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p><blockquote class="hero"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit posuere erat a ante.</p><small>Someone famous <cite title="Source Title">Source Title</cite></small></blockquote><p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique dimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p>',
            'display'   => 1,
            'type'      => config('mposuccess.news_type_company'),
            'img'       => 'news-test-3.jpg',
        ]);

        News::create([
            'name'      => 'News company 4',
            'preview'   => 'News company 4 News company 4 News company 4 News company 4 News company 4 News company 4 News company 4 News company 4 News company 4',
            'content'   => '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culp orem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p><blockquote class="hero"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit posuere erat a ante.</p><small>Someone famous <cite title="Source Title">Source Title</cite></small></blockquote><p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique dimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p>',
            'display'   => 1,
            'type'      => config('mposuccess.news_type_company'),
        ]);

        News::create([
            'name'      => 'News company 5',
            'preview'   => 'News company 5 News company 5 News company 5 News company 5 News company 5 News company 5',
            'content'   => '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culp orem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p><blockquote class="hero"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit posuere erat a ante.</p><small>Someone famous <cite title="Source Title">Source Title</cite></small></blockquote><p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique dimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p>',
            'display'   => 1,
            'type'      => config('mposuccess.news_type_company'),
        ]);

        News::create([
            'name'      => 'News company 6',
            'preview'   => 'News company 6 News company 6 News company 6 News company 6 News company 6',
            'content'   => '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culp orem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p><blockquote class="hero"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit posuere erat a ante.</p><small>Someone famous <cite title="Source Title">Source Title</cite></small></blockquote><p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique dimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p>',
            'display'   => 1,
            'type'      => config('mposuccess.news_type_company'),
            'img'       => 'news-test-1.jpg',
        ]);

        News::create([
            'name'      => 'News company 7',
            'preview'   => 'News company 7 News company 7 News company 7 News company 7 News company 7 News company 7 News company 7 News company 7 News company 7',
            'content'   => '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culp orem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p><blockquote class="hero"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit posuere erat a ante.</p><small>Someone famous <cite title="Source Title">Source Title</cite></small></blockquote><p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique dimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p>',
            'display'   => 1,
            'type'      => config('mposuccess.news_type_company'),
            'img'       => 'news-test-3.jpg',
        ]);

        News::create([
            'name'      => 'News company 8',
            'preview'   => 'News company 8 News company 8 News company 8 News company 8 News company 8 News company 8 News company 8 News company 8 News company 8',
            'content'   => '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culp orem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p><blockquote class="hero"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit posuere erat a ante.</p><small>Someone famous <cite title="Source Title">Source Title</cite></small></blockquote><p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique dimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p>',
            'display'   => 1,
            'type'      => config('mposuccess.news_type_company'),
            'img'       => 'news-test-2.jpg',
        ]);

        News::create([
            'name'      => 'News company 9',
            'preview'   => 'News company 9 News company 9 News company 9 News company 9 News company 9 News company 9 News company 9 News company 9 News company 9',
            'content'   => '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culp orem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p><blockquote class="hero"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit posuere erat a ante.</p><small>Someone famous <cite title="Source Title">Source Title</cite></small></blockquote><p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique dimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p>',
            'display'   => 1,
            'type'      => config('mposuccess.news_type_company'),
            'img'       => 'news-test-1.jpg',
        ]);

        News::create([
            'name'      => 'News company 10',
            'preview'   => 'News company 10 News company 10 News c',
            'content'   => '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culp orem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p><blockquote class="hero"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit posuere erat a ante.</p><small>Someone famous <cite title="Source Title">Source Title</cite></small></blockquote><p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique dimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p>',
            'display'   => 1,
            'type'      => config('mposuccess.news_type_company'),
        ]);

        News::create([
            'name'      => 'News company 11',
            'preview'   => 'News company 11 News company 11 News company 11 News company 11 News company 11 News company 11 News company 11 News company 11 News company 11 News company 11',
            'content'   => '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culp orem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p><blockquote class="hero"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit posuere erat a ante.</p><small>Someone famous <cite title="Source Title">Source Title</cite></small></blockquote><p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique dimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p>',
            'display'   => 1,
            'type'      => config('mposuccess.news_type_company'),
            'img'       => 'news-test-3.jpg',
        ]);

        News::create([
            'name'      => 'News company 12',
            'preview'   => 'News company 12 News company 12',
            'content'   => '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culp orem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p><blockquote class="hero"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit posuere erat a ante.</p><small>Someone famous <cite title="Source Title">Source Title</cite></small></blockquote><p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique dimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p>',
            'display'   => 1,
            'type'      => config('mposuccess.news_type_company'),
            'img'       => 'news-test-2.jpg',
        ]);


        /*
        * Create world news
        */
        News::create([
            'name'      => 'News world 1',
            'preview'   => 'News world 1 News world 1 News world 1 News world 1 News world 1 News world 1 News world 1 News world 1 News world 1 News world 1 News world 1 News world 1',
            'content'   => '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culp orem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p><blockquote class="hero"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit posuere erat a ante.</p><small>Someone famous <cite title="Source Title">Source Title</cite></small></blockquote><p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique dimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p>',
            'display'   => 1,
            'type'      => config('mposuccess.news_type_world'),
            'img'       => 'news-test-2.jpg',
        ]);

        News::create([
            'name'      => 'News world 2',
            'preview'   => 'News world 2 News world 2 News world 2 News world 2 News world 2 News world 2 News world 2 News world 2 News world ',
            'content'   => '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culp orem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p><blockquote class="hero"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit posuere erat a ante.</p><small>Someone famous <cite title="Source Title">Source Title</cite></small></blockquote><p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique dimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p>',
            'display'   => 1,
            'type'      => config('mposuccess.news_type_world'),
            'img'       => 'news-test-3.jpg',
        ]);

        News::create([
            'name'      => 'News world 3',
            'preview'   => 'News world 3 News world 3 News world 3 News world 3 News world 3 News world 3 News world 3 News world 3 News world 3',
            'content'   => '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culp orem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p><blockquote class="hero"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit posuere erat a ante.</p><small>Someone famous <cite title="Source Title">Source Title</cite></small></blockquote><p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique dimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p>',
            'display'   => 1,
            'type'      => config('mposuccess.news_type_world'),
            'img'       => 'news-test-2.jpg',
        ]);

        News::create([
            'name'      => 'News world 4',
            'preview'   => 'News world 4 News world 4 News world 4 News world 4 News world 4 News world 4 News world 4 News world 4 News world 4',
            'content'   => '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culp orem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p><blockquote class="hero"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit posuere erat a ante.</p><small>Someone famous <cite title="Source Title">Source Title</cite></small></blockquote><p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique dimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p>',
            'display'   => 1,
            'type'      => config('mposuccess.news_type_world'),
            'img'       => 'news-test-1.jpg',
        ]);

        News::create([
            'name'      => 'News world 5',
            'preview'   => 'News world 5 News world 5 News world 5 News world 5 News world 5 News world 5',
            'content'   => '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culp orem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p><blockquote class="hero"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit posuere erat a ante.</p><small>Someone famous <cite title="Source Title">Source Title</cite></small></blockquote><p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique dimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p>',
            'display'   => 1,
            'type'      => config('mposuccess.news_type_world'),
            'img'       => 'news-test-2.jpg',
        ]);

        News::create([
            'name'      => 'News world 6',
            'preview'   => 'News world 6 News world 6 News world 6 News world 6 News world 6',
            'content'   => '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culp orem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p><blockquote class="hero"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit posuere erat a ante.</p><small>Someone famous <cite title="Source Title">Source Title</cite></small></blockquote><p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique dimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p>',
            'display'   => 1,
            'type'      => config('mposuccess.news_type_world'),
        ]);

        News::create([
            'name'      => 'News world 7',
            'preview'   => 'News world 7 News world 7 News world 7 News world 7 News world 7 News world 7 News world 7 News world 7 News world 7',
            'content'   => '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culp orem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p><blockquote class="hero"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit posuere erat a ante.</p><small>Someone famous <cite title="Source Title">Source Title</cite></small></blockquote><p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique dimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p>',
            'display'   => 1,
            'type'      => config('mposuccess.news_type_world'),
        ]);

        News::create([
            'name'      => 'News world 8',
            'preview'   => 'News world 8 News world 8 News world 8 News world 8 News world 8 News world 8 News world 8 News world 8 News world 8',
            'content'   => '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culp orem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p><blockquote class="hero"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit posuere erat a ante.</p><small>Someone famous <cite title="Source Title">Source Title</cite></small></blockquote><p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique dimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p>',
            'display'   => 1,
            'type'      => config('mposuccess.news_type_world'),
        ]);

        News::create([
            'name'      => 'News world 9',
            'preview'   => 'News world 9 News world 9 News world 9 News world 9 News world 9 News world 9 News world 9 News world 9 News world 9',
            'content'   => '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culp orem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p><blockquote class="hero"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit posuere erat a ante.</p><small>Someone famous <cite title="Source Title">Source Title</cite></small></blockquote><p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique dimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p>',
            'display'   => 1,
            'type'      => config('mposuccess.news_type_world'),
            'img'       => 'news-test-3.jpg',
        ]);

        News::create([
            'name'      => 'News world 10',
            'preview'   => 'News world 10 News world 10 News c',
            'content'   => '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culp orem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p><blockquote class="hero"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit posuere erat a ante.</p><small>Someone famous <cite title="Source Title">Source Title</cite></small></blockquote><p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique dimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p>',
            'display'   => 1,
            'type'      => config('mposuccess.news_type_world'),
            'img'       => 'news-test-1.jpg',
        ]);

        News::create([
            'name'      => 'News world 11',
            'preview'   => 'News world 11 News world 11 News world 11 News world 11 News world 11 News world 11 News world 11 News world 11 News world 11 News world 11',
            'content'   => '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culp orem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p><blockquote class="hero"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit posuere erat a ante.</p><small>Someone famous <cite title="Source Title">Source Title</cite></small></blockquote><p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique dimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p>',
            'display'   => 1,
            'type'      => config('mposuccess.news_type_world'),
            'img'       => 'news-test-3.jpg',
        ]);

        News::create([
            'name'      => 'News world 12',
            'preview'   => 'News world 12 News world 12',
            'content'   => '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culp orem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p><blockquote class="hero"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit posuere erat a ante.</p><small>Someone famous <cite title="Source Title">Source Title</cite></small></blockquote><p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique dimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus.</p>',
            'display'   => 1,
            'type'      => config('mposuccess.news_type_world'),
        ]);

        Product::create([
            'name'      => 'Первая структура',
            'des'       => 'Купи это место и получи возможность заработать',
            'price'     => 999,
            'penny'     => 90,
            'what'      => 'Одно место',
            'url'       => 'one',
        ]);

        Product::create([
            'name'      => 'Вторая структура',
            'des'       => 'Купи это место и получи возможность заработать',
            'price'     => 999,
            'penny'     => 90,
            'what'      => 'Одно место',
            'url'       => 'two',
        ]);

        Product::create([
            'name'      => 'Третьч структура',
            'des'       => 'Купи это место и получи возможность заработать',
            'price'     => 999,
            'penny'     => 90,
            'what'      => 'Одно место',
            'url'       => 'three',
        ]);

        Product::create([
            'name'      => 'Четвертая структура',
            'des'       => 'Купи это место и получи возможность заработать',
            'price'     => 999,
            'penny'     => 90,
            'what'      => 'Одно место',
            'url'       => 'four',
        ]);


        Product::create([
            'name'      => 'Пятая структура',
            'des'       => 'Купи это место и получи возможность заработать',
            'price'     => 999,
            'penny'     => 90,
            'what'      => 'Одно место',
            'url'       => 'five',
        ]);


        TreeSetting::create([
            'level'          => '1',
            'cells_to_fill'  => '11',
            'first_pay'      => '12',
            'next_pay'       => '13',
            'sum_pay'        => '14',
            'invited'        => '0'
        ]);


        TreeSetting::create([
            'level'          => '2',
            'cells_to_fill'  => '21',
            'first_pay'      => '22',
            'next_pay'       => '23',
            'sum_pay'        => '24',
            'invited'        => '0'
        ]);


        TreeSetting::create([
            'level'          => '3',
            'cells_to_fill'  => '31',
            'first_pay'      => '0',
            'next_pay'       => '0',
            'sum_pay'        => '34',
            'invited'        => '35'
        ]);


        TreeSetting::create([
            'level'          => '4',
            'cells_to_fill'  => '41',
            'first_pay'      => '42',
            'next_pay'       => '43',
            'sum_pay'        => '44',
            'invited'        => '0'
        ]);


        TreeSetting::create([
            'level'          => '5',
            'cells_to_fill'  => '51',
            'first_pay'      => '52',
            'next_pay'       => '53',
            'sum_pay'        => '54',
            'invited'        => '0'
        ]);


        TreeSetting::create([
            'level'          => '6',
            'cells_to_fill'  => '61',
            'first_pay'      => '0',
            'next_pay'       => '0',
            'sum_pay'        => '64',
            'invited'        => '65'
        ]);
    }
}
