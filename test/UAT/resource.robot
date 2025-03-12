*** Settings ***
Library    SeleniumLibrary
Library    Collections

*** Variables ***
${BROWSER}          Chrome
${URL_HOME}         http://127.0.0.1:8000
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
${NEW_TAG3}         New_Tag_Test_3
${NEW_TAG4}         New_Tag_Test_4
${TAG_BANNER}       banner

${TITLE_EN_NEW}     Updated Title EN
${TITLE_TH_NEW}     อัปเดตชื่อภาษาไทย
${DESCRIPTION_EN_NEW}     Updated Description EN
${DESCRIPTION_TH_NEW}     อัปเดตคำอธิบายภาษาไทย
${IMAGE_EN_NEW}     ${CURDIR}/test_image_en_new.jpg
${IMAGE_TH_NEW}     ${CURDIR}/test_image_th_new.jpg
${PRIORITY_NEW}     2

*** Keywords ***
Open Browser To Home Page
    Open Browser    ${URL_HOME}    ${BROWSER}
    Maximize Browser Window

Open Login Page And Login
    Open Browser    ${URL_LOGIN}    ${BROWSER}
    Maximize Browser Window
    Sleep    2s
    Input Text    id=username    ${USERNAME}
    Input Text    id=password    ${PASSWORD}
    Click Login Button
    Wait Until Page Contains    Dashboard    5s
    
Close Browser Session
    SeleniumLibrary.Close Browser
    
# Add highlight

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

Click Add Tag Button
    Click Button    xpath=//button[contains(text(),'Add Tag')]
    
Click Manage Tags Button
    Wait Until Element Is Visible    xpath=//button[normalize-space()='Manage Tags']    5s
    Scroll Element Into View    xpath=//button[normalize-space()='Manage Tags']
    Click Element    xpath=//button[normalize-space()='Manage Tags']

Add New Tag
    Wait Until Element Is Visible    id=newTagName    5s
    Input Text    id=newTagName    ${NEW_TAG4}
    Sleep    1s
    Click Button    id=addTag
    Sleep    2s

Verify Tag Added
    Page Should Contain    ${NEW_TAG4}
    
Click Edit Tag Button
    Wait Until Element Is Visible    xpath=//tr[td[contains(text(),'${NEW_TAG4}')]]//td[contains(@class,'tag-name')]    5s
    Scroll Element Into View    xpath=//tr[td[contains(text(),'${NEW_TAG4}')]]//td[contains(@class,'tag-name')]
    Sleep    1s
    Input Text    xpath=//tr[td[contains(text(),'${NEW_TAG4}')]]//td[contains(@class,'tag-name')]    ${NEW_TAG3}
    Sleep    1s
    Click Element    xpath=//tr[td[contains(text(),'${NEW_TAG3}')]]//button[contains(@class,'update-tag')]
    Sleep    2s
    Handle Alert    ACCEPT
    Sleep    2s

Delete Tag
    Click Button    xpath=//button[contains(text(),'Add Tag')]
    Sleep    2s
    Click Element    xpath=//button[normalize-space()='Manage Tags']
    Sleep    2s
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
    Wait Until Element Is Visible    xpath=//tr[td[contains(text(),'${NEW_TAG3}')]]//button[contains(@class,'delete-tag')]    5s
    Scroll Element Into View    xpath=//tr[td[contains(text(),'${NEW_TAG3}')]]//button[contains(@class,'delete-tag')]
    Click Element    xpath=//tr[td[contains(text(),'${NEW_TAG3}')]]//button[contains(@class,'delete-tag')]
    Sleep    2s
    Handle Alert    ACCEPT
    Sleep    2s

Click Delete Highlight Button
    Wait Until Element Is Visible    xpath=(//button[contains(@class,'delete-btn')])[1]    5s
    Scroll Element Into View    xpath=(//button[contains(@class,'delete-btn')])[1]
    Sleep    1s
    Click Element    xpath=(//button[contains(@class,'delete-btn')])[1]
    Handle Alert    ACCEPT
    
Click Delete Multiple Highlights
    [Arguments]    ${COUNT}
    FOR    ${INDEX}    IN RANGE    ${COUNT}
        Wait Until Element Is Visible    xpath=(//button[contains(@class,'delete-btn')])[1]    5s
        Scroll Element Into View    xpath=(//button[contains(@class,'delete-btn')])[1]
        Sleep    1s
        Click Element    xpath=(//button[contains(@class,'delete-btn')])[1]
        ${ALERT_PRESENT} =    Run Keyword And Return Status    Alert Should Be Present
        Run Keyword If    ${ALERT_PRESENT}    Handle Alert    ACCEPT
        Sleep    1s
        Sleep    2s
    END

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
    Sleep    1s
    Wait Until Element Is Visible    xpath=//h5[contains(text(),'Select Tags')]    5s
    Wait Until Element Is Visible    xpath=//button[contains(text(),'KKU')]    5s
    Click Element    xpath=//button[contains(text(),'KKU')]
    Sleep    1s
    Wait Until Element Is Visible    xpath=//button[contains(text(),'researcher')]    5s
    Click Element    xpath=//button[contains(text(),'researcher')]
    Sleep    1s
    Wait Until Element Is Visible    xpath=//button[contains(text(),'CS')]    5s
    Click Element    xpath=//button[contains(text(),'CS')]
    Sleep    1s
    Click Button    xpath=//button[contains(text(),'Close')]
    Sleep    2s
    Wait Until Element Is Not Visible    id=tagModal    5s
    Sleep    1s
    
Add Banner Tags
    Click Button    xpath=//button[contains(text(), 'Add Tag')]
    Sleep    1s
    Wait Until Element Is Visible    xpath=//h5[contains(text(),'Select Tags')]    5s
    Wait Until Element Is Visible    xpath=//button[contains(text(),'KKU')]    5s
    Click Element    xpath=//button[contains(text(),'KKU')]
    Sleep    1s
    Wait Until Element Is Visible    xpath=//button[contains(text(),'researcher')]    5s
    Click Element    xpath=//button[contains(text(),'researcher')]
    Sleep    1s
    Wait Until Element Is Visible    xpath=//button[contains(text(),'CS')]    5s
    Click Element    xpath=//button[contains(text(),'CS')]
    Sleep    1s
    Wait Until Element Is Visible    id=newTagName    5s
    Input Text    id=newTagName    ${TAG_BANNER}
    Sleep    2s
    Click Button    xpath=//button[@id='addTempTag']
    Sleep    2s
    Click Button    xpath=//button[contains(text(),'Close')]
    Sleep    2s
    Wait Until Element Is Not Visible    id=tagModal    5s
    Sleep    1s

Add Exist Tags
    Click Button    xpath=//button[contains(text(),'Add Tag')]
    Wait Until Element Is Visible    xpath=//h5[contains(text(),'Select Tags')]    5s
    Wait Until Element Is Visible    id=newTagName    5s
    Input Text    id=newTagName    ${NEW_TAG}
    Click Button    xpath=//button[@id='addTempTag']
    Sleep    2s
    ${ALERT_RESULT} =    Run Keyword And Ignore Error    Handle Alert Error
    Run Keyword If    '${ALERT_RESULT}[0]' == 'PASS'    Log    Alert detected and closed.
    Run Keyword If    '${ALERT_RESULT}[0]' == 'PASS'    Set Variable    ${NEW_TAG2}    ${NEW_TAG2}
    Sleep    2s
    Input Text    id=newTagName    ${NEW_TAG2}
    Sleep    2s
    Click Button    xpath=//button[@id='addTempTag']
    Sleep    2s
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
    Page Should Contain    ${DESCRIPTION_EN}
    Page Should Contain    ${DESCRIPTION_TH}
    
Verify Highlight Edited
    Page Should Contain    ${TITLE_EN_NEW}
    Page Should Contain    ${TITLE_TH_NEW}
    Page Should Contain    ${DESCRIPTION_EN_NEW}
    Page Should Contain    ${DESCRIPTION_TH_NEW}
    
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
    Scroll Element Into View    xpath=(//div[@id='selected-tags']//span[contains(@class,'remove-tag')])[1]
    Sleep    1s
    Click Element    xpath=(//div[@id='selected-tags']//span[contains(@class,'remove-tag')])[1]
    Sleep    1s
    
# Home Page

Click First Highlight Banner
    Wait Until Element Is Visible    xpath=(//div[@class='carousel-item active']//a)[1]    5s
    Scroll Element Into View    xpath=(//div[@class='carousel-item active']//a)[1]
    Sleep    1s
    Click Element    xpath=(//div[@class='carousel-item active']//a)[1]
    Sleep    2s
    Wait For Page Load
    Sleep    2s

Verify Highlight Detail Page
    Wait Until Page Contains Element    xpath=//h1[contains(@class, 'fw-semibold')]    15s
    Page Should Contain    ${TITLE_EN}
    Wait Until Page Contains Element    xpath=//p[contains(@class, 'fs-5')]    10s
    Page Should Contain    ${DESCRIPTION_EN}
    
Wait For Page Load
    ${READY} =    Run Keyword And Return Status    Wait Until Page Contains Element    xpath=//body    10s
    Run Keyword If    ${READY}    Log    Page Loaded Successfully
    Sleep    2s

Click First Tag
    Wait Until Element Is Visible    xpath=(//a[contains(@href, '/highlight/tag/')])[1]    10s
    Scroll Element Into View    xpath=(//a[contains(@href, '/highlight/tag/')])[1]
    Sleep    1s
    Click Element    xpath=(//a[contains(@href, '/highlight/tag/')])[1]

Verify Highlight List Page
    Wait Until Page Contains Element    xpath=//h3[contains(text(), 'Highlight สำหรับแท็ก:')]    15s
    Page Should Contain Element    xpath=//h3[contains(text(), 'Highlight สำหรับแท็ก:')]
    Wait Until Element Is Visible    xpath=//div[contains(@class, 'card highlight-card')]    10s
    Page Should Contain Element    xpath=//div[contains(@class, 'card highlight-card')]
    
Click First Highlight In List
    Wait Until Element Is Visible    xpath=(//div[contains(@class, 'highlight-card')]//img)[1]    10s
    Scroll Element Into View    xpath=(//div[contains(@class, 'highlight-card')]//img)[1]
    Sleep    1s
    Click Element    xpath=(//div[contains(@class, 'highlight-card')]//img)[1]
    
Click First Highlight In List From Tag
    Wait Until Element Is Visible    xpath=(//div[contains(@class, 'highlight-card')]//a)[1]    10s
    Scroll Element Into View    xpath=(//div[contains(@class, 'highlight-card')]//a)[1]
    Sleep    1s
    Click Element    xpath=(//div[contains(@class, 'highlight-card')]//a)[1]
    Sleep    2s