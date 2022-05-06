/* global $*/
$(function(){
  // テキストアニメーション
  const title = $('#first').text();
  //console.log(title);
  $('#first').text('');
  let count = 1;
  // text_animation関数を定義
  const text_animation = () => {
      const word = title.substr(0, count);
      // 挙動確認
      console.log(word);
      $('#first').text(word);
      count++;
      if(count > title.length) {
          clearInterval(timer);
      }
  };
  
  //タイマー処理、text_animation関数の実行(0,1秒間隔でタイピングのように文字を表示)。
  const timer = setInterval(text_animation, 100);
    
});