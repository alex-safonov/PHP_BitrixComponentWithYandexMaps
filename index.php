<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Адреса офисов и партнеров Мартинес Имидж — Официальный дистрибьютор Мартинес Имидж");
$APPLICATION->SetTitle("Официальный дистрибьютор Мартинес Имидж");
?><?/* $APPLICATION->IncludeComponent(
	"daglob:breadcrumb",
	"index",
	Array(
		"START_FROM" => "0",
		"PATH" => "",
		"SITE_ID" => "s1"
	)
); */?> 
<br />
 
<div style="border: 2px solid rgb(255, 0, 0); width: 99%; text-align: center;"> 
  <p style="color: rgb(0, 0, 0); font-size: 20px;"> <b>Работа компании &laquo;Мартинес Имидж&raquo; во время майских праздников:</b> 
    <br />
  1-5 и 9-11 мая - выходные дни. 
    <br />
  6 - 8 мая и с 12 мая - временно работаем в дистанционном режиме до снятия ограничений, введенных правительством РФ. </p>
 </div>
 <?$APPLICATION->IncludeComponent(
	"daglob:centre.list", 
	"template1", 
	array(
		
	),
	false
);?> 
<br />
 <section class="blockContent"> <b>Юридический адрес: </b>115093, г. Москва, Люсиновская, д. 53 
  <br />
 <b>Наименование организации:</b> Общество с ограниченной ответственностью «Ассоциация косметологов и мезотерапевтов» 
  <br />
 <b>ОГРН</b>: №1037704005460 
  <br />
 
  <br />
 </section> <? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>