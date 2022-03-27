/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

function setPrefecture() {

    // idが一桁の時はゼロうめする
    var prefecture_id = ('00' + $('#preflist').val()).slice(-2);
    // var prefecture_id = $('#preflist').val();
    var city_id = $('#city_id').val();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        url: "/search/prefecture",
        data: { "prefecture_id": prefecture_id },
        dataType: "json"
    }).done(function (data) {
        // selectタグ（子） の option値 を一旦削除
        $('#city option').remove();
        $('#city').append($('<option>').text('全域').attr('value', ''));
        // 戻って来た data の値をそれそれ optionタグ として生成し、
        // city に optionタグ を追加する
        $.each(data['data'], function (id) {
            // 選択済みの市区町村の場合はselected属性を付与してoptionタグを生成
            if (data['data'][id]['name'] == city_id) {
                $('#city').append($('<option>').text(data['data'][id]['name']).attr('value', data['data'][id]['name']).attr('selected', 'selected'));
            } else {
                $('#city').append($('<option>').text(data['data'][id]['name']).attr('value', data['data'][id]['name']));
            }
        });

        // for (var i = 0; i < $('#city option').length; i++) {
        //     console.log($('#city option').text());
        // }
        
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log("失敗");
        console.log("ajax通信に失敗しました");
        console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
        console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラー
        console.log("errorThrown    : " + errorThrown.message); // 例外情報
        console.log("URL            : " + url);
    });
}

$(function() {
    // 都道府県プルダウンが変更またはクリックされた場合
    $('#preflist').on('change click', function() {
        setPrefecture();
    })
});

$(window).on('load', function() {
    console.log($('#preflist').val());
    if ($('#preflist').val() != '') {
        setPrefecture();
    }
});

const app = new Vue({
    el: '#app',
});
