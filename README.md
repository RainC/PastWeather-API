PastWeather-API
===============



더이상 지원하지 않습니다. 서비스 종료.



이 API 는 DaumKakao 의 날씨 페이지를 파싱하여 날씨정보를 가져오는 것 입니다.

PHP 5.3 이상 실행 가능한 환경이여야 합니다. (권장)


File Description

simple_html_dom.php - HTML Parse 작업에 필요한 라이브러리 파일 입니다.
weather_api.php     - 라이브러리랑 연동하여 파싱 작업을 해주는 파일 입니다. (메인)


-- API Guide

지원되는 Request Method : GET

출력 방법 : JSON


두가지 파라미터 종류로 출력할수 있습니다.

필수 파라미터 : year, month , area

선택 파라미터 : day



EXAMPLE USAGE

12월달의 날씨를 모두 가져오고 싶을때
GET /weather_api.php?year=2013&month=12&area=서울

12월 14일의 날씨를 가져오고 싶을 때
GET /weather_api.php?year=2013&month=12&area=서울&day=14


이 API 사용 또는 기타 문의가 있으시다면 이쪽으로 연락 주세요. support@rainclab.net


