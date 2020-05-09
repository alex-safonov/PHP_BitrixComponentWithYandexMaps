<?
use Bitrix\Main\Page\Asset;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
if (!empty($arResult['ITEMS'])) {
    Asset::getInstance()->addCss('/css/include/activityNavigator.css', true);
    Asset::getInstance()->addJs('/js/include/activityNavigator.min.js', true);
    Asset::getInstance()->addJs('https://api-maps.yandex.ru/2.1/?lang=ru_RU', true);
    $mapSpKey = "map";
    ?>
    <section class="CCentreList">
        <section class="blockContent">
            <h1 id="headLine">Адреса офисов и партнеров Мартинес Имидж - официального дистрибьютора профессиональной
                косметики в России</h1>
            <?
            if (!empty($arResult['TABS'])) {
                ?>
                <article class="activity-menu">
                    <ul>
                        <?
                        foreach ($arResult['TABS'] as $tabKey => $tabName) {
                            ?>
                            <li>
                                <button data-scroll-to="city<?= $tabKey ?>"><?= $tabName ?></button>
                            </li>
                        <?
                        }
                        ?>
                    </ul>
                </article>
            <?
            }
            ?>
        </section>
        <?foreach ($arResult['ITEMS'] as $contactCenter) {
           
                $idMapList[$mapSpKey . $contactCenter['ID']] = array(
                    "name"    => $contactCenter['NAME'],
                    "coords"  => $contactCenter['MAP']['VALUE'],
                    "address" => $contactCenter['ADDRESS']['VALUE'],
                    "link"    => $contactCenter['DETAIL_PAGE_URL'],
                );
                $foto_center = CFile::GetPath($contactCenter['DETAIL_PICTURE']);
            ?>

<?if(false):?>
<?global $USER;
if ($USER->IsAdmin()):?>
<pre style="background:#f9ffa4;border:2px solid #f00;padding:5px;">
    <?print_r($foto_center);?>
</pre>
<?endif;?>
<?endif;?>

            <section class="blockContent">
                <div class="centerBlock" itemscope itemtype="http://schema.org/Organization">
                    <span itemprop="name"><span class="user_h2_4"
                            id="city<?= $contactCenter['ID'] ?>"><?= $contactCenter['NAME'] ?></span></span>

                    <div class="link_to">
                    <span  style="background-color: #d9d9d9; padding: 5px 5px;"><b>Офис продаж | <a href='/edu/<?= $contactCenter['CODE']?>/'>Учебно-методический центр >>></a></b></span>
                    </div>

                    <div class="address">
                        <?
                        $tel = '';
                        if (!empty($contactCenter['PHONE']['VALUE'])) {
                            $tel = '<span itemprop="telephone">' . array_shift($contactCenter['PHONE']['VALUE']) . '</span>';
                            // $tel = ', тел: <span itemprop="telephone">' . array_shift($contactCenter['PHONE']['VALUE']) . '</span>';
                        }
                        $email = '';
                        if ($contactCenter['MAIL']['VALUE'] != '' && filter_var(trim($contactCenter['MAIL']['VALUE']), FILTER_VALIDATE_EMAIL)) {
                            $email = '<span itemprop="email">' . $contactCenter['MAIL']['VALUE'] . '</span>';
                            // $email = ', <span itemprop="email">' . $contactCenter['MAIL']['VALUE'] . '</span>';
                        }
                      
                        ?>
                        <span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">


<!--                             <?//if($contactCenter['CODE'] == "tsentralnyy_ofis"): ?> Главный офис: <span itemprop="streetAddress"><?= $contactCenter['ADDRESS']['VALUE'] ?></span></span><?= $tel ?><?= $email ?>

<?//else:?> -->


<!--                             Адрес<?//if($contactCenter['PARTNER']['VALUE'] == "Да"):?> партнера<?//endif;?>: <span itemprop="streetAddress"><?= $contactCenter['ADDRESS']['VALUE'] ?></span></span><?= $tel ?><?= $email ?> -->


                            <b></br>Адрес: </b> <span itemprop="streetAddress"><?= $contactCenter['ADDRESS']['VALUE'] ?></span></span></br>
                            <b>Телефон: </b><?= $tel ?></br>
                            <b>E-mail: </b><?= $email ?></br>
                            <b>Время работы: </b><?= $contactCenter['SCHEDULE_DETAILS']['VALUE'] ?></br>
                            


<!--                             <?//endif;?> -->

<!--
							Адрес<?//if($contactCenter['PARTNER']['VALUE'] == "Да"):?> партнера<?//endif;?>: <span itemprop="addressLocality">г. <?= $contactCenter['CITY']['VALUE'] ?></span>, <span itemprop="streetAddress"><?= $contactCenter['ADDRESS']['VALUE'] ?></span></span><?= $tel ?><?= $email ?>
-->
					</div>




                            <div class="wrapper" style=" display: flex;"; >
                                <div class="col one" style=" flex-basis:49%;  margin: 20px 0;"   ">
   
                                   <img src="<?=$foto_center?>" width="461"; height="400"; padding-right="10px";>

                                </div>
                                <div class="col two" style=" flex-basis:2%; "></div>
                                <div class="col three" style=" flex-basis: 49%; ">
                                    <div id="<?= $mapSpKey . $contactCenter['ID'] ?>" class="map"></div>
                                </div>
                            
                            </div>
                    
                       
                    <div class="detailDescription">
                        <?= htmlspecialchars_decode($contactCenter['PREVIEW_TEXT']) ?>
                    </div>
                </div>
            </section>
        <?
        } ?>
    </section>
    <script type="text/javascript">
        var myMaps;
        ymaps.ready(function () {
            var mapList = ['<?=implode("','",array_keys($idMapList))?>'];
            var mapElementData = <?=json_encode($idMapList)?>;
            for (var s in mapList) {
                var mapID = mapList[s],
                    myMap,
                    name = mapElementData[mapID].name,
                    address = mapElementData[mapID].address,
                    link = mapElementData[mapID].link,
                    coords = mapElementData[mapID].coords.split(",");
                if (coords == '') {
                    continue;
                }
                myMap = new ymaps.Map(mapID, {
                    center: coords,
                    zoom: 13
                });
                var baloonContent = "" +
                    "<div class='name'>" +
                    name
                "</div>" +
                "<div class='address'>" +
                address
                "</div>";
                if (link != '') {
                    baloonContent += "<a href='" + link + "'>Подробнее</a>"
                }
                myMap.geoObjects.add(new ymaps.Placemark(coords, {
                    balloonContent: baloonContent
                }, {
                    preset: 'islands#icon',
                    iconColor: '#ff0000'
                }));
                myMap.controls.remove('searchControl');
                myMap.controls.remove('routeEditor');
                myMap.controls.remove('trafficControl');
                myMap.controls.remove('geolocationControl');
                myMap.controls.remove('typeSelector');
                myMap.controls.remove('rulerControl');
                myMap.behaviors.disable('scrollZoom');
            }
        });
    </script>
<?
}
