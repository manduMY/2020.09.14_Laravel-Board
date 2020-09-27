Laravel + Vue SPA + MariaDB + Redis + tdd
===

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

게시판 기능

- Keyword: Vue, SPA, MariaDB, Redis, TDD
- 개발 기간: 2020.09.14 ~ 2020.09.27

게시판 CRUD 기능 구현하기.

<br/>

개발 환경
---
Window10, Vagrant, PHP 7.4

<br/>

샘플 화면
---
CRUD 기능

| Create: 게시글 생성 |
|:----------------------------------------:|
|<img src="markdown/img/BoardCreate.gif" width=1000 />|

| Read: 상세글 읽기 |
|:----------------------------------------:|
|<img src="markdown/img/BoardRead.gif" width=1000 />|

| Update: 게시글 수정 |
|:----------------------------------------:|
|<img src="markdown/img/BoardUpdate.gif" width=1000 />|

| Delete: 글 삭제 |
|:----------------------------------------:|
|<img src="markdown/img/BoardDelete.gif" width=1000 />|

<br/>

DataBase
---
MariaDB

<img src="markdown/img/Main_technical_element.png" width=1000 >

Redis 기능

| Redis: Set, Get을 이용한 캐쉬 기능 |
|:----------------------------------------:|
|<img src="markdown/img/Redis.gif" width=1000 />|

<br/>

TDD (테스트 주도 개발)
---
/tests/Feature/ContentControllerTest.php 파일에 테스트 메서드 작성 했습니다.
CRUD 기능을 가지고 있는 파일(ContentController.php)을 중점적으로 테스트 했습니다.

Controller 메서드들을 확인한 테스트 수행 결과
<img src="markdown/img/TDD.png" width=1000 >

<br/>

Vue.js SPA
---
- Componet
  - 컴포넌트는 Board.vue, ContentDetail.vue, Create.vue, Header.vue로 구성되어 있습니다.
  - Header 컴포넌트는 웹페이지 상단에 고정이며 게시판 CRUD 기능 수행시 Board, ContentDetail, Create 컴포넌트만 바꿨습니다.

- Vue-Router
  - routes.js 파일에 라우터들을 선언 해놓고 각 컴포넌트에서 활용했습니다.
  - router.push를 통해 주소로 id값을 주고받을 때 편했습니다.
  
- axios
  - 클라이언트에서 서버간 통신을 하기 위해 사용했습니다.
  - get, post, put, delete 기능을 통해 Controller에 있는 CRUD 기능에 편하게 접근할 수 있었습니다.
  - javascript의 ajax와 비슷한 느낌이며 비동기 처리를 위해 async와 await를 사용했습니다.
  
<br/>
