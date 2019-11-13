<?php

namespace Tests\unit\Application\UseCases;


use PHPUnit\Framework\TestCase;
use TKuni\PhpWordExtractor\Application\UseCases\interfaces\IWordExtractInteractor;

class WordExtractInteractorTest extends TestCase
{
    /**
     * @test
     */
    public function extract_()
    {
        /*
         * PhpStorm, MySQL, PHP, Laravelを含む文章群
         */
        $sentences = [
            "今更だけどPhpStorm買った。
秀丸卒業しようと思って。",
            "PhpStorm ・VM・Xdebug の関係性がいまいちわかってないな。デバッグの設定とかわかるようになるのか不安",
            "MacBook Pro 13 inchに4Kモニター繋げるとPhpStormでの入力が重くなる件、eGPU抜きでもウィンドウサイズを小さくすればだいぶ軽減される。タブを並べて表示したいときはSplitせずに別ウィンドウに出してしまえば小さいサイズを維持できる。",
            "PHPStormのせいでThinkPadのトラックポイントを使う修行が始まりました。
もうマウスいらないかもしれない。",
            "PHPStormのToday's hint 勉強になる。",
            "ありがたい（その2） >> \"入れ子集合モデル（検索編）：MySQLで階層化データを使う\" makizou.com/1637/",
            "しかし、PHPでは自動的に型を判断してくれるため、意識する必要はないといっていい。ただ他の言語を学ぶ時に意識していないと苦労することがある。(体験談。。。) #PHP #MySQL",
            "MySQLのバックアップ取得方法
bit.ly/2szaeuU",
            "MySQLのDockerイメージをイチから作成する - ROXX(旧SCOUTER)開発者ブログ

IT企業技術ブログ等アンテナより
techblog.roxx.co.jp/entry/2019/11/…",
            "MySQLはINTERSECTがないのか",
            "PHPに関する情報を主に更新していきます！フォローよろしくお願いします！",
            "WordPress kirk PHP 7.4 完全対応 早っ!。",
            "Laravelで定数をconfig配下のファイルに記載していましたが、enumにまとめて振る舞いも追加したらいい感じになりました。

PHPで列挙型(enum)を作る qiita.com/Hiraku/items/7… #Qiita",
            "if(PHP勉強会@東京 開催のお知らせ){
    return 申し込む;
}",
            "おいでませweb業界
Git docker webpack laravelでお仕事しましょ",
            "リモートワークしやすい言語の1つであるjavascriptライブラリで人気はReact。

ただし、react nativeがよく検索されているみたいで、Laravel（PHP）との組み合わせではVue.jsが急上昇してますね。

ただ、周りのもくもく会では圧倒的にVue.jsが人気なのでちょっと不思議🤔

trends.google.com/trends/explore…",
            "Laravelの課題終わった〜！！

フロントの勉強にうつってもいいかをメンターに聞いたらまだSQLの理解が浅いからサーバー側を勉強すべきとのこと。うおおおおおお〜俺はいつになったらReactとかで俺ツエーできるんや

でも、今プログラマーとしてやれてるのは今のメンターのおかげだから完全に服従",
        ];


        $interactor =  app()->make(IWordExtractInteractor::class);

        $actual = $interactor->extract($sentences);

        $expect = [
            "PhpStorm",
            "MySQL",
            "PHP",
            "Laravel"
        ];

        $this->assertEquals($expect, $actual);
    }
}