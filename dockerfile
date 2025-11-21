FROM php:8.2-apache

نسخ ملفات المشروع إلى مجلد السيرفر
COPY . /var/www/html/

إعداد صلاحيات الوصول
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

تفعيل إعادة كتابة الروابط إن كنت تستخدم .htaccess
RUN a2enmod rewrite

تعيين مجلد العمل
WORKDIR /var/www/html
