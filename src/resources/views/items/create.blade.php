<form action="/sell" method="POST">
  @csrf

  <input type="text" name="name" placeholder="商品名">
  <input type="number" name="price" placeholder="価格">
  <input type="text" name="brand" placeholder="ブランド">
  <textarea name="description"></textarea>
  <input type="text" name="img_url" placeholder="画像URL">
  <input type="text" name="condition" placeholder="状態">

  <button type="submit">出品</button>
</form>