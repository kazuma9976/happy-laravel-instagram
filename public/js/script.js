/* global $*/
$(function(){
  
  // テキストアニメーション
  const title = $('#first').text();
  $('#first').text('');
  let count = 1;
  
  // text_animation関数を定義
  const text_animation = () => {
      const word = title.substr(0, count);
      $('#first').text(word);
      count++;
      if(count > title.length) {
          clearInterval(timer);
      }
  };
  
  //タイマー処理、text_animation関数の実行(0,1秒間隔でタイピングのように文字を表示)。
  const timer = setInterval(text_animation, 100);
  
  // 各種画像のプレビュー表示
  $(document).on('change', '#preview-uploader', function(){
    
        //操作された要素を取得
        let image = this;
        //ファイルを読み取るオブジェクトを生成
        let fileReader = new FileReader();
        //ファイルを読み取る
        fileReader.readAsDataURL(image.files[0]);
        
        // ファイルを読み取り後
        fileReader.onload = (function () {                        
            //img要素を生成
            let imgTag = `<img src='${fileReader.result}'>`;     
            //画像を表示
            $(image).next("#preview").html(imgTag);   
            
        });
  });
    
});