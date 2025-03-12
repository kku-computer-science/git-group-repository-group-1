*** Settings ***
Library    SeleniumLibrary

*** Variables ***
${BROWSER}    Chrome
${URL}    http://127.0.0.1:8000
@{EXPECTED_WORDS_HOME}    รายงานจำนวนบทความทั้งหมด (ในระยะเวลา 5 ปี)    ผลงานตีพิมพ์ (5 ปี ย้อนหลัง)
@{EXPECTED_WORDS_RESEARCHER_CS}    ผู้วิจัย    สาขาวิชาวิทยาการคอมพิวเตอร์    ค้นหา
@{EXPECTED_WORDS_RESEARCHER_IT}    ผู้วิจัย    สาขาวิชาเทคโนโลยีสารสนเทศ    ค้นหา    
@{EXPECTED_WORDS_RESEARCHER_GIS}    ผู้วิจัย    สาขาวิชาภูมิสารสนเทศศาสตร์    ค้นหา
@{EXPECTED_WORDS_RESEARCH_PROJECT}    โครงการบริการวิชาการ/โครงการวิจัย    ลำดับ    ปี    ชื่อโครงการ    รายละเอียด
@{EXPECTED_WORDS_RESEARCH_GROUP}    กลุ่มงานวิจัย    รายละเอียดเพิ่มเติม
@{EXPECTED_WORDS_REPORT}    สถิติจำนวนบทความทั้งหมด 5 ปี    สถิติจำนวนบทความที่ได้รับการอ้างอิง

*** Keywords ***
Open Browser To Home Page
    Open Browser    ${URL}    ${BROWSER}
    Maximize Browser Window

Open Browser To Researcher_cs Page
    Open Browser    ${URL}/researchers/1    ${BROWSER}
    Maximize Browser Window

Open Browser To Researcher_it Page
    Open Browser    ${URL}/researchers/2    ${BROWSER}
    Maximize Browser Window

Open Browser To Researcher_gis Page
    Open Browser    ${URL}/researchers/3    ${BROWSER}
    Maximize Browser Window

Open Browser To Research Project Page
    Open Browser    ${URL}/researchproject    ${BROWSER}
    Maximize Browser Window

Open Browser To Research Group Page
    Open Browser    ${URL}/researchgroup    ${BROWSER}
    Maximize Browser Window

Open Browser To Reports Page
    Open Browser    ${URL}/reports    ${BROWSER}
    Maximize Browser Window

Close Browser
    SeleniumLibrary.Close Browser