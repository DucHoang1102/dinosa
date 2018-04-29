# dinosa
Dự án dinosa
- Phần mềm quản lý áo in Dinosa
- Start project: 
  + Truy cập ssh -> cd vào: dinosa/apps -> gõ cmd: composer install
  + Tạo và copy nội dung vào file .env từ file .env.example. Sửa trường DB_HOST và DB_DATABASE, Tắt Debug APP_DEBUG=false (Nếu copy .env thì phải xóa APP_KEY cũ)
  + Tạo generate key gõ cmd: php artisan key:generate
  + Coppy ảnh sản phẩm vào file upload. Tất cả ảnh sp phải nằm trong thư mục "d-p-1234"
  + Tạo folder chứa mail gửi vận chuyển: "mail-orders"
