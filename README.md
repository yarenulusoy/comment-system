PHP VE AJAX KULLANARAK YORUM YAPMA VE CEVAP VERME SİSTEMİ

Veri tabanı:
```
CREATE TABLE `tbl_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `comment_date` date NOT NULL,
  `comment` text NOT NULL,
  `id_reply` int(11) NOT NULL
) 
```

![Ekran Görüntüsü (2)](https://user-images.githubusercontent.com/45559372/117380096-b0156980-aee1-11eb-85c7-f7119d6969a9.png)
![Ekran Görüntüsü (3)](https://user-images.githubusercontent.com/45559372/117380077-a986f200-aee1-11eb-8887-be3639127e5d.png)
