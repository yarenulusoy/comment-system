PHP VE AJAX KULLANARAK YORUM YAPMA VE CEVAP VERME SİSTEMİ

Veri tabanı :
CREATE TABLE `tbl_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `comment_date` date NOT NULL,
  `comment` text NOT NULL,
  `id_reply` int(11) NOT NULL
)
