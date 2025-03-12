# Changelog (บันทึกการเปลี่ยนแปลงระบบ) 
ชื่อระบบ : Research Document Management System
เป้าหมายในการพัฒนาและปรับปรุงระบบ : เพื่อใช้ในการรวบรวมงานวิจัยจากอาจารย์ในมหาวิทยาลัยขอนแก่น วิทยาลัยการคอมพิวเตอร์ ซึ่งถูกพัฒนาโดยนักศึกษาที่ได้จบการศึกษาไปแล้ว

## Product Backlog ที่เลือกแก้ไขและพัฒนา
*Product Backlog Items No.9 : As an administrative staff, I want to present the highlights to all visitors.*

## แก้ไขล่าสุด 12/03/2568
**📌ฟังก์ชันที่เพิ่มและทำการแก้ไข**
* แสดงรายละเอียด highlight
    - แสดงคำอธิบาย หัวข้อและ Tag ในเนื้อหาของข่าว
* Menu manage highlight
    - แก้ไข เพิ่ม(Add)และลบข่าว
* Add highlight
    - เพิ่ม(Add)คำอธิบาย หัวข้อ และติด tag ในเนื่อหาข่าว
* Add Tag
    - เลือกแท็กที่ต้องการให้แสดงในเนื้อหา highlight 
    - สร้าง(Add)แท็กเพิ่มเติมจากหน้านี้ได้
* Manage Tags
    - สร้าง(Add)แท็กเพิ่มเติมจากหน้านี้ได้
    - สามารถลบ และ เปลี่ยนชื่อแท็กเดิมที่มีอยู่ได้

**📌Database**
* เพิ่มตาราง highlight 
* เพิ่มตาราง tags
* เพิ่มตาราง highlight_has_tags
