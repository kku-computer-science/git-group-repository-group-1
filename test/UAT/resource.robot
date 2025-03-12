*** Settings ***
Library    SeleniumLibrary
Library    Collections

*** Variables ***
${BROWSER}          Chrome
${URL_LOGIN}        http://127.0.0.1:8000/login
${USERNAME}         staff@gmail.com
${PASSWORD}         123456789
${TITLE_EN}         Test Title EN
${TITLE_TH}         ทดสอบชื่อเรื่อง TH
${DESCRIPTION_EN}   This is a test description in English.
${DESCRIPTION_TH}   นี่คือคำอธิบายทดสอบในภาษาไทย
${IMAGE_EN}         ${CURDIR}/test_image_en.jpg
${IMAGE_TH}         ${CURDIR}/test_image_th.jpg
${PRIORITY}         1
${NEW_TAG}          New_Tag_Test_1
${NEW_TAG2}         New_Tag_Test_2

${TITLE_EN_NEW}     Updated Title EN
${TITLE_TH_NEW}     อัปเดตชื่อภาษาไทย
${DESCRIPTION_EN_NEW}     Updated Description EN
${DESCRIPTION_TH_NEW}     อัปเดตคำอธิบายภาษาไทย
${IMAGE_EN_NEW}     ${CURDIR}/test_image_en_new.jpg
${IMAGE_TH_NEW}     ${CURDIR}/test_image_th_new.jpg
${PRIORITY_NEW}     2


*** Keywords ***
Open Login Page And Login
    Open Browser    ${URL_LOGIN}    ${BROWSER}
    Maximize Browser Window
    Sleep    3s
    Input Text    id=username    ${USERNAME}
    Input Text    id=password    ${PASSWORD}
    Click Login Button
    Wait Until Page Contains    Dashboard    5s

Click Login Button
    Click Button    xpath=//button[contains(text(), 'LOGIN')]

Click Manage Highlight Menu
    Click Element    xpath=//a[contains(@class, 'nav-link') and .//span[contains(text(), 'Manage Highlights')]]

Click Add Highlight Button
    Click Element    xpath=//a[contains(@class, 'btn-primary') and .//i[contains(@class, 'mdi-plus')]]
    
Click Update Button
    Wait Until Element Is Visible    xpath=//button[contains(text(),'Update')]    5s
    Scroll Element Into View    xpath=//button[contains(text(),'Update')]
    Sleep    1s
    Click Button    xpath=//button[contains(text(),'Update')]

Delete Tag
    Click Button    xpath=//button[contains(text(),'Add Tag')]
    Sleep    3s
    Click Element    xpath=//button[normalize-space()='Manage Tags']
    Sleep    3s
    Wait Until Element Is Visible    xpath=//tr[td[contains(text(),'${NEW_TAG}')]]//button[contains(@class,'delete-tag')]    5s
    Scroll Element Into View    xpath=//tr[td[contains(text(),'${NEW_TAG}')]]//button[contains(@class,'delete-tag')]
    Click Element    xpath=//tr[td[contains(text(),'${NEW_TAG}')]]//button[contains(@class,'delete-tag')]
    Sleep    2s
    Handle Alert    ACCEPT
    Sleep    2s
    Wait Until Element Is Visible    xpath=//tr[td[contains(text(),'${NEW_TAG2}')]]//button[contains(@class,'delete-tag')]    5s
    Scroll Element Into View    xpath=//tr[td[contains(text(),'${NEW_TAG2}')]]//button[contains(@class,'delete-tag')]
    Click Element    xpath=//tr[td[contains(text(),'${NEW_TAG2}')]]//button[contains(@class,'delete-tag')]
    Sleep    2s
    Handle Alert    ACCEPT
    Sleep    2s

Fill Highlight Form
    Input Text    name=title_en    ${TITLE_EN}
    Input Text    name=title_th    ${TITLE_TH}
    Input Text    name=description_en    ${DESCRIPTION_EN}
    Input Text    name=description_th    ${DESCRIPTION_TH}
    Choose File    name=image_en    ${IMAGE_EN}
    Choose File    name=image_th    ${IMAGE_TH}
    Input Text    name=priority    ${PRIORITY}
    
Add Tags
    Click Button    xpath=//button[contains(text(),'Add Tag')]
    Wait Until Element Is Visible    xpath=//h5[contains(text(),'Select Tags')]    5s
    Wait Until Element Is Visible    xpath=//button[contains(text(),'KKU')]    5s
    Click Element    xpath=//button[contains(text(),'KKU')]
    Click Element    xpath=//button[contains(text(),'researcher')]
    Click Element    xpath=//button[contains(text(),'CS')]
    Wait Until Element Is Visible    id=newTagName    5s
    Input Text    id=newTagName    ${NEW_TAG}
    Click Button    xpath=//button[@id='addNewTag']
    Sleep    3s
    Click Button    xpath=//button[contains(text(),'Close')]

Add Exist Tags
    Click Button    xpath=//button[contains(text(),'Add Tag')]
    Wait Until Element Is Visible    xpath=//h5[contains(text(),'Select Tags')]    5s
    Wait Until Element Is Visible    id=newTagName    5s
    Input Text    id=newTagName    ${NEW_TAG}
    Click Button    xpath=//button[@id='addNewTag']
    Sleep    3s
    ${ALERT_RESULT} =    Run Keyword And Ignore Error    Handle Alert Error
    Run Keyword If    '${ALERT_RESULT}[0]' == 'PASS'    Log    Alert detected and closed.
    Run Keyword If    '${ALERT_RESULT}[0]' == 'PASS'    Set Variable    ${NEW_TAG2}    ${NEW_TAG2}
    Sleep    3s
    Input Text    id=newTagName    ${NEW_TAG2}
    Sleep    3s
    Click Button    xpath=//button[@id='addNewTag']
    Sleep    3s
    Click Button    xpath=//button[contains(text(),'Close')]

Handle Alert Error
    ${ALERT_TEXT} =    Handle Alert
    Log    Alert Closed: ${ALERT_TEXT}

Submit Highlight Form
    Scroll Element Into View    xpath=//button[contains(text(), 'Save')]
    Click Button    xpath=//button[contains(text(), 'Save')]

Verify Highlight Added
    Page Should Contain    ${TITLE_EN}
    Page Should Contain    ${TITLE_TH}
    
Verify Highlight Edited
    Page Should Contain    ${TITLE_EN_NEW}
    Page Should Contain    ${TITLE_TH_NEW}
    
Click Edit Highlight Button
    Wait Until Element Is Visible    xpath=//td[contains(@class,'text-center')]//a[contains(@class, 'btn-outline-success')]    5s
    Scroll Element Into View    xpath=//td[contains(@class,'text-center')]//a[contains(@class, 'btn-outline-success')]
    Sleep    1s
    Click Element    xpath=//td[contains(@class,'text-center')]//a[contains(@class, 'btn-outline-success')]
    
Fill Edit Highlight Form
    Wait Until Element Is Visible    name=title_en    5s
    Clear Element Text    name=title_en
    Input Text    name=title_en    ${TITLE_EN_NEW}
    Clear Element Text    name=title_th
    Input Text    name=title_th    ${TITLE_TH_NEW}
    Clear Element Text    name=description_en
    Input Text    name=description_en    ${DESCRIPTION_EN_NEW}
    Clear Element Text    name=description_th
    Input Text    name=description_th    ${DESCRIPTION_TH_NEW}
    Choose File    name=image_en    ${IMAGE_EN_NEW}
    Choose File    name=image_th    ${IMAGE_TH_NEW}
    Input Text    name=priority    ${PRIORITY_NEW}
    Sleep    2s
    
Remove One Tag In Edit Form
    Sleep    2s
    Wait Until Element Is Visible    xpath=//div[@id='selected-tags']//span[contains(@class,'remove-tag')]    5s
    Click Element    xpath=(//div[@id='selected-tags']//span[contains(@class,'remove-tag')])[1]
    Sleep    1s
    

Close Browser Session
    SeleniumLibrary.Close Browser