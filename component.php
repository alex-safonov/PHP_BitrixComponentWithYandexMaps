<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
if (!\Bitrix\Main\Loader::includeModule("iblock")) {
    return;
}

$arResult = array();
$arSelect = Array( "*" );
$arFilter = Array(
    "IBLOCK_CODE"                        => "training_centers", //подключаем инфоблок с учебными центрами
    "ACTIVE"                             => "Y", //выбираем активные учебные центры
    "PROPERTY_INSERT_INTO_CONTACTS_PAGE" => 1
);

$tcOb = CIBlockElement::GetList(
    array( "SORT" => "ASC" ),
    $arFilter,
    false, false,
    $arSelect
);

while ($tcData = $tcOb->GetNextElement()) { //перебираем масси с учебными центрами
    $arFields = $tcData->GetFields();
    $arProperty = $tcData->GetProperties();
    $arResult['TABS'][$arFields['ID']] = $arProperty['CITY']['VALUE'];
    $arResult['ITEMS'][] = array_merge($arFields, $arProperty);
}
$this->IncludeComponentTemplate($template);