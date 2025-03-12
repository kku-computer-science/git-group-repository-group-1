# 📃คู่มือการใช้งานระบบ (User Manual) 
ชื่อระบบ : Research Document Management System
เป้าหมายในการพัฒนาและปรับปรุงระบบ : เพื่อใช้ในการรวบรวมงานวิจัยจากอาจารย์ในมหาวิทยาลัยขอนแก่น วิทยาลัยการคอมพิวเตอร์ ซึ่งถูกพัฒนาโดยนักศึกษาที่ได้จบการศึกษาไปแล้ว

---
## Product Backlog ที่เลือกแก้ไขและพัฒนา
*Product Backlog Items No.9 : As an administrative staff, I want to present the highlights to all visitors.*

## ขั้นตอนการใช้งาน
### **📌สำหรับ Visitors**
เนื้อหา : เพื่อแสดงรายละเอียดเพิ่มเติมเกี่ยวกับข่าว

1. กดที่ highlight เพื่อดูรายละเอียด

2. กด Tag เพื่อดูข่าวสารที่ติด tag เดียวกันเพิ่มเติม

### **📌สำหรับ Administrative staff**
เนื้อหา : เพื่อให้ผู้ดูแลระบบสามารถสร้าง แก้ไข และสามารถลบ Highlight ได้

1. เข้าหน้า main page และกด login

2. login เข้าใช้งานในฐานะ Administrative staff กรอก Username และ password สำหรับ Administrative staff

3. เมื่อเข้าสู่ระบบแล้ว ผู้ใช้จะอยู่ที่หน้า Dashboard ไปที่ menu manage highlight ที่อยู่มุมซ้ายด้านล่างสุด

**สร้าง Highlight**
1. สร้าง Highlight ใหม่โดยการ Add New Highlight

2. ติดแท็กได้โดยการ Add Tag  

3. สามารถสร้าง Tag ใหม่ได้โดยการ Add Tag หรือเพิ่มจาก Manage Tags สามารถแก้ไข Tag เดิมที่มีอยู่ได้ด้วยการเปลี่ยนชื่อ หรือ ลบ

4. กดบันทึก(Save)เพื่อยืนยันการเพิ่มเนื้อหา 

**แก้ไข Highlight**
1. แก้ไข Highlight โดยการกดปุ่ม edit

2. สามารแก้ไขคำอธิบาย หัวข้อ Tag และลำดับความสำคัญได้

3. กดบันทึก(Save)เพื่อยืนยันการแก้ไขเนื้อหา 

**ลบ Highlight**
1. ลบ Highlight โดยการกดปุ่ม delete

2. จะแสดงแจ้งเตือน Are you sure you want to delete this highlight? ยืนยันความต้องการโดยการกด ok

---
### **📌Impact on User (ผลที่เกิดกับ User)**
* Administrative staff
    - สาารถเพิ่ม แก้ไข และลบ Highlight ได้

* Visitors
    - สามารถอ่านรายละเอียดของ Highlight ได้
    - สามารถอ่านเนื้อหาที่คล้ายกันหรือเกี่ยวข้องกันได้จาก Tag 
