<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dreamstar on Kel'Thuzad - GearScores.com</title>
<meta name="keywords" content="gearscore, gearscores, wow, warcraft, gear score, gear scores, gear, score, scores, armory">
<meta name="description" content="GearScore calculator, compare your gearscore to other players in the world, easily view raid experience, 3D character models, character comments, and much more!">
<meta name="google-site-verification" content="DH9kofgezUIysYNf9XIuXIlTUFsPEMOVAeGWAW48DkQ" />
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<script src="http://static.wowhead.com/widgets/power.js"></script>

<link rel="stylesheet" type="text/css" href="http://gearscores.com/style.css" />

<script language="javascript">
function updateRealmList(num,fieldName,anyOption) {
	var region = 'region'+num;
	var server = 'divServer'+num;
	fieldName = fieldName || 's';
	anyOption = anyOption || false;
	var anyOptionField = '';
	if (anyOption) { anyOptionField = '<option value="any">Any</option>'; }
	var curServer = document.getElementById('server'+num).value.replace(/\\/g,'');
	var eurealms = "<select name=\""+fieldName+"\" id=\"server"+num+"\">"+anyOptionField+"<option>Aerie Peak</option><option>Agamaggan</option><option>Aggramar</option><option>Ahn'Qiraj</option><option>Al'Akir</option><option>Alexstrasza</option><option>Alleria</option><option>Alonsus</option><option>Aman'Thul</option><option>Ambossar</option><option>Anachronos</option><option>Anetheron</option><option>Antonidas</option><option>Anub'arak</option><option>Arak-arahm</option><option>Arathi</option><option>Arathor</option><option>Archimonde</option><option>Area 52</option><option>Argent Dawn</option><option>Arthas</option><option>Arygos</option><option>Aszune</option><option>Auchindoun</option><option>Azjol-Nerub</option><option>Azshara</option><option>Azuremyst</option><option>Baelgun</option><option>Balnazzar</option><option>Blackhand</option><option>Blackmoore</option><option>Blackrock</option><option>Blade's Edge</option><option>Bladefist</option><option>Bloodfeather</option><option>Bloodhoof</option><option>Bloodscalp</option><option>Blutkessel</option><option>Boulderfist</option><option>Bronze Dragonflight</option><option>Bronzebeard</option><option>Burning Blade</option><option>Burning Legion</option><option>Burning Steppes</option><option>C'thun</option><option>Chamber of Aspects</option><option>Chants éternels</option><option>Cho'gall</option><option>Chromaggus</option><option>Colinas Pardas</option><option>Confrérie du Thorium</option><option>Conseil des Ombres</option><option>Crushridge</option><option>Culte de la Rive Noire</option><option>Daggerspine</option><option>Dalaran</option><option>Dalvengyr</option><option>Darkmoon Faire</option><option>Darksorrow</option><option>Darkspear</option><option>Das Konsortium</option><option>Das Syndikat</option><option>Deathwing</option><option>Defias Brotherhood</option><option>Dentarg</option><option>Der abyssische Rat</option><option>Der Mithrilorden</option><option>Der Rat von Dalaran</option><option>Destromath</option><option>Dethecus</option><option>Die Aldor</option><option>Die Arguswacht</option><option>Die ewige Wacht</option><option>Die Nachtwache</option><option>Die Silberne Hand</option><option>Die Todeskrallen</option><option>Doomhammer</option><option>Draenor</option><option>Dragonblight</option><option>Dragonmaw</option><option>Drak'thul</option><option>Drek'Thar</option><option>Dun Modr</option><option>Dun Morogh</option><option>Dunemaul</option><option>Durotan</option><option>Earthen Ring</option><option>Echsenkessel</option><option>Eitrigg</option><option>Eldre'thalas</option><option>Elune</option><option>Emerald Dream</option><option>Emeriss</option><option>Eonar</option><option>Eredar</option><option>Executus</option><option>Exodar</option><option>Festung der Stürme</option><option>Forscherliga</option><option>Frostmane</option><option>Frostmourne</option><option>Frostwhisper</option><option>Frostwolf</option><option>Garona</option><option>Garrosh</option><option>Genjuros</option><option>Ghostlands</option><option>Gilneas</option><option>Gorgonnash</option><option>Grim Batol</option><option>Gul'dan</option><option>Hakkar</option><option>Haomarush</option><option>Hellfire</option><option>Hellscream</option><option>Hyjal</option><option>Illidan</option><option>Jaedenar</option><option>Kael'Thas</option><option>Karazhan</option><option>Kargath</option><option>Kazzak</option><option>Kel'Thuzad</option><option>Khadgar</option><option>Khaz Modan</option><option>Khaz'goroth</option><option>Kil'Jaeden</option><option>Kilrogg</option><option>Kirin Tor</option><option>Kor'gall</option><option>Krag'jin</option><option>Krasus</option><option>Kul Tiras</option><option>Kult der Verdammten</option><option>La Croisade écarlate</option><option>Laughing Skull</option><option>Les Clairvoyants</option><option>Les Sentinelles</option><option>Lightbringer</option><option>Lightning's Blade</option><option>Lordaeron</option><option>Los Errantes</option><option>Lothar</option><option>Madmortem</option><option>Magtheridon</option><option>Mal'Ganis</option><option>Malfurion</option><option>Malorne</option><option>Malygos</option><option>Mannoroth</option><option>Marécage de Zangar</option><option>Mazrigos</option><option>Medivh</option><option>Minahonda</option><option>Moonglade</option><option>Mug'thol</option><option>Nagrand</option><option>Nathrezim</option><option>Naxxramas</option><option>Nazjatar</option><option>Nefarian</option><option>Neptulon</option><option>Ner'zhul</option><option>Nera'thor</option><option>Nethersturm</option><option>Nordrassil</option><option>Norgannon</option><option>Nozdormu</option><option>Onyxia</option><option>Outland</option><option>Perenolde</option><option>Proudmoore</option><option>Quel'Thalas</option><option>Ragnaros</option><option>Rajaxx</option><option>Rashgarroth</option><option>Ravencrest</option><option>Ravenholdt</option><option>Rexxar</option><option>Runetotem</option><option>Sanguino</option><option>Sargeras</option><option>Saurfang</option><option>Scarshield Legion</option><option>Sen'jin</option><option>Shadowsong</option><option>Shattered Halls</option><option>Shattered Hand</option><option>Shattrath</option><option>Shen'dralar</option><option>Silvermoon</option><option>Sinstralis</option><option>Skullcrusher</option><option>Spinebreaker</option><option>Sporeggar</option><option>Steamwheedle Cartel</option><option>Stormrage</option><option>Stormreaver</option><option>Stormscale</option><option>Sunstrider</option><option>Suramar</option><option>Sylvanas</option><option>Taerar</option><option>Talnivarr</option><option>Tarren Mill</option><option>Teldrassil</option><option>Temple noir</option><option>Terenas</option><option>Terokkar</option><option>Terrordar</option><option>The Maelstrom</option><option>The Sha'tar</option><option>The Venture Co</option><option>The Venture Co.</option><option>Theradras</option><option>Thrall</option><option>Throk'Feroth</option><option>Thunderhorn</option><option>Tichondrius</option><option>Tirion</option><option>Todeswache</option><option>Trollbane</option><option>Turalyon</option><option>Twilight's Hammer</option><option>Twisting Nether</option><option>Tyrande</option><option>Uldaman</option><option>Ulduar</option><option>Uldum</option><option>Un'Goro</option><option>Varimathras</option><option>Vashj</option><option>Vek'lor</option><option>Vek'nilash</option><option>Vol'jin</option><option>Wildhammer</option><option>Wrathbringer</option><option>Xavius</option><option>Ysera</option><option>Ysondre</option><option>Zenedar</option><option>Zirkel des Cenarius</option><option>Zul'jin</option><option>Zuluhed</option><option>Азурегос</option><option>Борейская тундра</option><option>Вечная Песня</option><option>Галакронд</option><option>Гордунни</option><option>Гром</option><option>Дракономор</option><option>Король-лич</option><option>Пиратская бухта</option><option>Подземье</option><option>Разувий</option><option>Ревущий фьорд</option><option>Свежеватель Душ</option><option>Седогрив</option><option>Страж смерти</option><option>Термоштепсель</option><option>Ткач Смерти</option><option>Черный Шрам</option><option>Ясеневый лес</option></select>".replace("value=\""+curServer+"\"", "value=\""+curServer+"\" selected=\"selected\"");
	var usrealms = "<select name=\""+fieldName+"\" id=\"server"+num+"\">"+anyOptionField+"<option value=\"Aegwynn\">Aegwynn</option><option value=\"Aerie Peak\">Aerie Peak</option><option value=\"Agamaggan\">Agamaggan</option><option value=\"Aggramar\">Aggramar</option><option value=\"Akama\">Akama</option><option value=\"Alexstrasza\">Alexstrasza</option><option value=\"Alleria\">Alleria</option><option value=\"Altar of Storms\">Altar of Storms</option><option value=\"Alterac Mountains\">Alterac Mountains</option><option value=\"Aman'Thul\">Aman'Thul</option><option value=\"Andorhal\">Andorhal</option><option value=\"Anetheron\">Anetheron</option><option value=\"Antonidas\">Antonidas</option><option value=\"Anub'arak\">Anub'arak</option><option value=\"Anvilmar\">Anvilmar</option><option value=\"Arathor\">Arathor</option><option value=\"Archimonde\">Archimonde</option><option value=\"Area 52\">Area 52</option><option value=\"Argent Dawn\">Argent Dawn</option><option value=\"Arthas\">Arthas</option><option value=\"Arygos\">Arygos</option><option value=\"Auchindoun\">Auchindoun</option><option value=\"Azgalor\">Azgalor</option><option value=\"Azjol-Nerub\">Azjol-Nerub</option><option value=\"Azshara\">Azshara</option><option value=\"Azuremyst\">Azuremyst</option><option value=\"Baelgun\">Baelgun</option><option value=\"Balnazzar\">Balnazzar</option><option value=\"Barthilas\">Barthilas</option><option value=\"Black Dragonflight\">Black Dragonflight</option><option value=\"Blackhand\">Blackhand</option><option value=\"Blackrock\">Blackrock</option><option value=\"Blackwater Raiders\">Blackwater Raiders</option><option value=\"Blackwing Lair\">Blackwing Lair</option><option value=\"Blade's Edge\">Blade's Edge</option><option value=\"Bladefist\">Bladefist</option><option value=\"Bleeding Hollow\">Bleeding Hollow</option><option value=\"Blood Furnace\">Blood Furnace</option><option value=\"Bloodhoof\">Bloodhoof</option><option value=\"Bloodscalp\">Bloodscalp</option><option value=\"Bonechewer\">Bonechewer</option><option value=\"Borean Tundra\">Borean Tundra</option><option value=\"Boulderfist\">Boulderfist</option><option value=\"Bronzebeard\">Bronzebeard</option><option value=\"Burning Blade\">Burning Blade</option><option value=\"Burning Legion\">Burning Legion</option><option value=\"Caelestrasz\">Caelestrasz</option><option value=\"Cairne\">Cairne</option><option value=\"Cenarion Circle\">Cenarion Circle</option><option value=\"Cenarius\">Cenarius</option><option value=\"Cho'gall\">Cho'gall</option><option value=\"Chromaggus\">Chromaggus</option><option value=\"Coilfang\">Coilfang</option><option value=\"Crushridge\">Crushridge</option><option value=\"Daggerspine\">Daggerspine</option><option value=\"Dalaran\">Dalaran</option><option value=\"Dalvengyr\">Dalvengyr</option><option value=\"Dark Iron\">Dark Iron</option><option value=\"Darkspear\">Darkspear</option><option value=\"Darrowmere\">Darrowmere</option><option value=\"Dath'Remar\">Dath'Remar</option><option value=\"Dawnbringer\">Dawnbringer</option><option value=\"Deathwing\">Deathwing</option><option value=\"Demon Soul\">Demon Soul</option><option value=\"Dentarg\">Dentarg</option><option value=\"Destromath\">Destromath</option><option value=\"Dethecus\">Dethecus</option><option value=\"Detheroc\">Detheroc</option><option value=\"Doomhammer\">Doomhammer</option><option value=\"Draenor\">Draenor</option><option value=\"Dragonblight\">Dragonblight</option><option value=\"Dragonmaw\">Dragonmaw</option><option value=\"Drak'Tharon\">Drak'Tharon</option><option value=\"Drak'thul\">Drak'thul</option><option value=\"Draka\">Draka</option><option value=\"Dreadmaul\">Dreadmaul</option><option value=\"Drenden\">Drenden</option><option value=\"Dunemaul\">Dunemaul</option><option value=\"Durotan\">Durotan</option><option value=\"Duskwood\">Duskwood</option><option value=\"Earthen Ring\">Earthen Ring</option><option value=\"Echo Isles\">Echo Isles</option><option value=\"Eitrigg\">Eitrigg</option><option value=\"Eldre'Thalas\">Eldre'Thalas</option><option value=\"Elune\">Elune</option><option value=\"Emerald Dream\">Emerald Dream</option><option value=\"Eonar\">Eonar</option><option value=\"Eredar\">Eredar</option><option value=\"Executus\">Executus</option><option value=\"Exodar\">Exodar</option><option value=\"Farstriders\">Farstriders</option><option value=\"Feathermoon\">Feathermoon</option><option value=\"Fenris\">Fenris</option><option value=\"Firetree\">Firetree</option><option value=\"Fizzcrank \">Fizzcrank </option><option value=\"Frostmane\">Frostmane</option><option value=\"Frostmourne\">Frostmourne</option><option value=\"Frostwolf\">Frostwolf</option><option value=\"Galakrond\">Galakrond</option><option value=\"Garithos\">Garithos</option><option value=\"Garona\">Garona</option><option value=\"Garrosh\">Garrosh</option><option value=\"Ghostlands\">Ghostlands</option><option value=\"Gilneas\">Gilneas</option><option value=\"Gnomeregan\">Gnomeregan</option><option value=\"Gorefiend\">Gorefiend</option><option value=\"Gorgonnash\">Gorgonnash</option><option value=\"Greymane\">Greymane</option><option value=\"Grizzly Hills\">Grizzly Hills</option><option value=\"Gul'dan\">Gul'dan</option><option value=\"Gundrak\">Gundrak</option><option value=\"Gurubashi\">Gurubashi</option><option value=\"Hakkar\">Hakkar</option><option value=\"Haomarush\">Haomarush</option><option value=\"Hellscream\">Hellscream</option><option value=\"Hydraxis\">Hydraxis</option><option value=\"Hyjal\">Hyjal</option><option value=\"Icecrown\">Icecrown</option><option value=\"Illidan\">Illidan</option><option value=\"Jaedenar\">Jaedenar</option><option value=\"Jubei'Thos\">Jubei'Thos</option><option value=\"Kael'thas\">Kael'thas</option><option value=\"Kalecgos\">Kalecgos</option><option value=\"Kargath\">Kargath</option><option value=\"Kel'Thuzad\">Kel'Thuzad</option><option value=\"Khadgar\">Khadgar</option><option value=\"Khaz Modan\">Khaz Modan</option><option value=\"Khaz'goroth\">Khaz'goroth</option><option value=\"Kil'jaeden\">Kil'jaeden</option><option value=\"Kilrogg\">Kilrogg</option><option value=\"Kirin Tor\">Kirin Tor</option><option value=\"Korgath\">Korgath</option><option value=\"Korialstrasz\">Korialstrasz</option><option value=\"Kul Tiras\">Kul Tiras</option><option value=\"Laughing Skull\">Laughing Skull</option><option value=\"Lethon\">Lethon</option><option value=\"Lightbringer\">Lightbringer</option><option value=\"Lightning's Blade\">Lightning's Blade</option><option value=\"Lightninghoof\">Lightninghoof</option><option value=\"Llane\">Llane</option><option value=\"Lothar\">Lothar</option><option value=\"Madoran\">Madoran</option><option value=\"Maelstrom\">Maelstrom</option><option value=\"Magtheridon\">Magtheridon</option><option value=\"Maiev\">Maiev</option><option value=\"Mal'Ganis\">Mal'Ganis</option><option value=\"Malfurion\">Malfurion</option><option value=\"Malorne\">Malorne</option><option value=\"Malygos\">Malygos</option><option value=\"Mannoroth\">Mannoroth</option><option value=\"Medivh\">Medivh</option><option value=\"Misha\">Misha</option><option value=\"Mok'Nathal\">Mok'Nathal</option><option value=\"Moon Guard \">Moon Guard </option><option value=\"Moonrunner\">Moonrunner</option><option value=\"Mug'thol\">Mug'thol</option><option value=\"Muradin\">Muradin</option><option value=\"Nagrand\">Nagrand</option><option value=\"Nathrezim\">Nathrezim</option><option value=\"Nazgrel\">Nazgrel</option><option value=\"Nazjatar\">Nazjatar</option><option value=\"Ner'zhul\">Ner'zhul</option><option value=\"Nesingwary\">Nesingwary</option><option value=\"Nordrassil\">Nordrassil</option><option value=\"Norgannon\">Norgannon</option><option value=\"Onyxia\">Onyxia</option><option value=\"Perenolde\">Perenolde</option><option value=\"Proudmoore\">Proudmoore</option><option value=\"Quel'dorei\">Quel'dorei</option><option value=\"Ravencrest\">Ravencrest</option><option value=\"Ravenholdt\">Ravenholdt</option><option value=\"Rexxar\">Rexxar</option><option value=\"Rivendare\">Rivendare</option><option value=\"Runetotem\">Runetotem</option><option value=\"Sargeras\">Sargeras</option><option value=\"Saurfang\">Saurfang</option><option value=\"Scarlet Crusade\">Scarlet Crusade</option><option value=\"Scilla\">Scilla</option><option value=\"Sen'jin\">Sen'jin</option><option value=\"Sentinels\">Sentinels</option><option value=\"Shadow Council\">Shadow Council</option><option value=\"Shadowmoon\">Shadowmoon</option><option value=\"Shadowsong\">Shadowsong</option><option value=\"Shandris\">Shandris</option><option value=\"Shattered Halls\">Shattered Halls</option><option value=\"Shattered Hand\">Shattered Hand</option><option value=\"Shu'halo\">Shu'halo</option><option value=\"Silver Hand\">Silver Hand</option><option value=\"Silvermoon\">Silvermoon</option><option value=\"Sisters of Elune\">Sisters of Elune</option><option value=\"Skullcrusher\">Skullcrusher</option><option value=\"Skywall\">Skywall</option><option value=\"Smolderthorn\">Smolderthorn</option><option value=\"Spinebreaker\">Spinebreaker</option><option value=\"Spirestone\">Spirestone</option><option value=\"Staghelm\">Staghelm</option><option value=\"Steamwheedle Cartel\">Steamwheedle Cartel</option><option value=\"Stonemaul\">Stonemaul</option><option value=\"Stormrage\">Stormrage</option><option value=\"Stormreaver\">Stormreaver</option><option value=\"Stormscale\">Stormscale</option><option value=\"Suramar\">Suramar</option><option value=\"Tanaris\">Tanaris</option><option value=\"Terenas\">Terenas</option><option value=\"Terokkar\">Terokkar</option><option value=\"Thaurissan\">Thaurissan</option><option value=\"The Forgotten Coast\">The Forgotten Coast</option><option value=\"The Scryers\">The Scryers</option><option value=\"The Underbog\">The Underbog</option><option value=\"The Venture Co\">The Venture Co</option><option value=\"Thorium Brotherhood\">Thorium Brotherhood</option><option value=\"Thrall\">Thrall</option><option value=\"Thunderhorn\">Thunderhorn</option><option value=\"Thunderlord\">Thunderlord</option><option value=\"Tichondrius\">Tichondrius</option><option value=\"Tortheldrin\">Tortheldrin</option><option value=\"Trollbane\">Trollbane</option><option value=\"Turalyon\">Turalyon</option><option value=\"Twisting Nether\">Twisting Nether</option><option value=\"Uldaman\">Uldaman</option><option value=\"Uldum\">Uldum</option><option value=\"Undermine\">Undermine</option><option value=\"Ursin\">Ursin</option><option value=\"Uther\">Uther</option><option value=\"Vashj\">Vashj</option><option value=\"Vek'nilash\">Vek'nilash</option><option value=\"Velen\">Velen</option><option value=\"Warsong\">Warsong</option><option value=\"Whisperwind\">Whisperwind</option><option value=\"Wildhammer\">Wildhammer</option><option value=\"Windrunner\">Windrunner</option><option value=\"Winterhoof\">Winterhoof</option><option value=\"Wyrmrest Accord\">Wyrmrest Accord</option><option value=\"Ysera\">Ysera</option><option value=\"Ysondre\">Ysondre</option><option value=\"Zangarmarsh\">Zangarmarsh</option><option value=\"Zul'jin\">Zul'jin</option><option value=\"Zuluhed\">Zuluhed</option></select>".replace("value=\""+curServer+"\"", "value=\""+curServer+"\" selected=\"selected\"");
	var currentRegion = document.getElementById(region).value;
	if (currentRegion == "eu") document.getElementById(server).innerHTML = eurealms;
	else document.getElementById(server).innerHTML = usrealms;
}

function updateSpecList(num) {
	var specList = 'divSpec'+num;
	var className = document.getElementById('class'+num).value;
	switch (className) {
		case 'deathknight':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="Blood">Blood</option><option value="Frost">Frost</option><option value="Unholy">Unholy</option></select>';
			break;
    case 'druid':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="Balance">Balance</option><option value="Feral Combat">Feral Combat</option><option value="Restoration">Restoration</option></select>';
			break;
    case 'hunter':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="Beast Mastery">Beast Mastery</option><option value="Marksmanship">Marksmanship</option><option value="Survival">Survival</option></select>';
			break;
    case 'mage':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="Arcane">Arcane</option><option value="Fire">Fire</option><option value="Frost">Frost</option></select>';
			break;
    case 'paladin':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="Holy">Holy</option><option value="Protection">Protection</option><option value="Retribution">Retribution</option></select>';
			break;
    case 'priest':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="Discipline">Discipline</option><option value="Holy">Holy</option><option value="Shadow">Shadow</option></select>';
			break;
    case 'rogue':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="Assassination">Assassination</option><option value="Combat">Combat</option><option value="Subtlety">Subtlety</option></select>';
			break;
    case 'shaman':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="Elemental">Elemental</option><option value="Enhancement">Enhancement</option><option value="Restoration">Restoration</option></select>';
			break;
    case 'warlock':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="Affliction">Affliction</option><option value="Demonology">Demonology</option><option value="Destruction">Destruction</option></select>';
			break;
    case 'warrior':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option><option value="Arms">Arms</option><option value="Fury">Fury</option><option value="Protection">Protection</option></select>';
			break;
	case 'any':
			document.getElementById(specList).innerHTML = '<select name="rsp" id="spec3" style="width:120px;"><option value="any" selected="selected">Any</option></select>';
			break;
		default:
			break;
	}
	return true;
}


function postToURL(url, values) 
{ 
    values = values || {}; 
	
    try {
		var form = document.createElement('form');
		form.setAttribute('id', 'dynamicForm1');
		form.setAttribute('name', 'dynamicForm1');
		form.setAttribute('method', 'post');
		form.setAttribute('action', url);
	}
	catch (e) {
		var form = document.createElement('<form id="dynamicForm1" name="dynamicForm1" method="post" action="'+url+'" >');
	}
	var i=0;
    for (var property in values) 
    { 
		var value = values[property]; 
		try { 
			form.appendChild(document.createElement('input')); 
			form.childNodes[i].setAttribute('type', 'hidden');
			form.childNodes[i].setAttribute('name', property);
			form.childNodes[i].setAttribute('value', value);
		}
		catch (e) {
			form.appendChild(document.createElement('<input type="hidden" name="'+property+'" value="'+value+'">')); 
		}
		i++;
    }
    document.body.appendChild(form); 
    form.submit(); 
    document.body.removeChild(form); 
}

function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		document.getElementById(limitCount).innerHTML =  limitField.value.length;
	}
}


function stateChanged(loc) {
	if (xmlHttp.readyState==4)	{ 
		document.getElementById(loc).innerHTML=xmlHttp.responseText;
	}
}
 
function GetXmlHttpObject()
{
	var xmlHttp=null;
	try  {
	  // Firefox, Opera 8.0+, Safari
	  xmlHttp=new XMLHttpRequest();
	}
	catch (e) {
	  // Internet Explorer
	  try {
		xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
	  }
	  catch (e) {
		xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	}
	return xmlHttp;
}


function voteComment(id, type, loc) {
	if (id.length==0) { 
	  document.getElementById(loc).innerHTML="";
	  return;
	}
	xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null) {
	  return;
	} 
	var url="id="+id;
	url=url+"&type="+type;
	xmlHttp.onreadystatechange= function() {stateChanged(loc);};
	xmlHttp.open("POST","/includes/voteComment.php",true);
	xmlHttp.setRequestHeader('Content-type',
		   'application/x-www-form-urlencoded;charset=UTF-8;');
	xmlHttp.send(url);
}

function insertChar(loc, char) {
	document.getElementById(loc).value = document.getElementById(loc).value + char;
}

function getRaidExp(loc) 
{ 
    loc = loc || 'charExp1';
	document.getElementById(loc).innerHTML='<table border="0" cellspacing="0" cellpadding="0" class="charInfo"><tr><td align="center" valign="top"><table border="0" cellpadding="0" cellspacing="0"><tr><td><div class="dropshadow"><table border="0" cellpadding="0" cellspacing="0"><tr><td colspan="2" align="center" valign="middle" class="busyText">Retrieving raid experience <img src="images/busy.gif" width="18" height="18" align="texttop" /></td></tr></table></div></td></tr></table></td></tr></table>';
	xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null) {
	  return;
	} 
	var url="n=Dreamstar";
	url=url+"&s=Kel%27Thuzad";
	url=url+"&r=us";
	xmlHttp.onreadystatechange= function() {stateChanged(loc);};
	xmlHttp.open("POST","includes/getCharExp.php",true);
	xmlHttp.setRequestHeader('Content-type',
		   'application/x-www-form-urlencoded;charset=UTF-8;');
	xmlHttp.send(url);
}
 
</script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-10915748-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body><div align="center">

<table width="996" align="center" border="0" cellspacing="0" cellpadding="0" class="borderFrame">
  <tr>
    <td width="20" align="center" valign="middle"></td>
    <td colspan="3" align="center" valign="middle" class="topSearchFrame">
    	<table width="100%" align="left" border="0" cellspacing="0" cellpadding="0">
        	<tr>
            	<td align="left"><a href="http://gearscores.com/character.php?n=Dreamstar&amp;s=Kel%27Thuzad&amp;r=us">Permanent Link</a></td>
        		<td align="right">Welcome Dreamstar! &nbsp;&nbsp;<a href="http://gearscores.com/logout.php">[Log Out]</a></td>
    		</tr>
        </table>
    </td>
    <td width="20" align="center" valign="middle"></td>
  </tr>
  <tr>
    <td width="180" rowspan="3" align="left" valign="middle" class="borderFrameLeftShadow"></td>
    <td colspan="3" align="center" valign="middle" class="borderFrameTop"></td>
    <td width="180" rowspan="3" align="right" valign="middle" class="borderFrameRightShadow"></td>
  </tr>
  <tr>
    <td width="28" align="center" valign="middle" class="borderFrameLeft"></td>
    <td align="center" valign="middle" class="borderFrameMainTable"><table border="0" align="center" cellpadding="0" cellspacing="0" class="mainContent">
      <tr>
        <td colspan="2" class="mainContentTopSearch"></td>
      </tr>
                <tr>
                	<td colspan="5" style="vertical-align:bottom;text-align:center;background-color:black;"><? include '/home/gearscores/public_html/includes/media/111.php'; ?>
                    </td>
                </tr>
      <tr>
        <td colspan="2" class="mainContentBannerTop"></td>
      </tr>
      <tr>
      	<td>
            <table align="center" cellpadding="0" cellspacing="0" class="mainContentTopBanner">
            	<tr>
                	<td width="250" class="mainContentLogo" align="left" valign="middle">
                        <a href="http://gearscores.com"><img src="http://gearscores.com/images/logo.png" class="logoImage" /></a>
            		</td>
            		<td width="750" style="vertical-align:bottom;text-align:right;"><? //include '/home/gearscores/public_html/includes/media/7.php'; ?></td>
            	</tr>
            </table>
        </td>
      </tr>
      <tr>
        <td colspan="2" class="mainContentBannerBottom"></td>
      </tr>
      <!--<tr>
        <td colspan="2" class="mainContentMenuFrameTop"></td>
      </tr>-->
      <tr>
        <td colspan="2" align="center" valign="middle" class="mainContentMenuFrame">
        	<table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="2" align="center" valign="middle" class="menuSpacer" id="menuSpacer"></td>
                <td width="50" align="center" valign="middle" class="inactive" id="menuHome"><a href="http://gearscores.com">Home</a></td>
                <td width="2" align="center" valign="middle" class="menuSpacer" id="menuSpacer"></td>
                <td width="145" align="center" valign="middle" class="active" id="menuSearch"><a href="http://gearscores.com/character.php">Character Search</a></td>
                <td width="2" align="center" valign="middle" class="menuSpacer" id="menuSpacer"></td>
                <td width="75" align="center" valign="middle" class="inactive" id="menuRankings"><a href="http://gearscores.com/rankings.php">Rankings</a></td>
                <td width="2" align="center" valign="middle" class="menuSpacer" id="menuSpacer"></td>
                <td width="50" align="center" valign="middle" class="inactive" id="menuRankings"><a href="http://gearscores.com/login.php">Log In</a></td>
                <td width="2" align="center" valign="middle" class="menuSpacer" id="menuSpacer"></td>
              </tr>
              </table>
        </td>
      </tr>
      <tr>
        <td colspan="2" class="mainContentMenuFrameBottom"></td>
      </tr>
      <tr>
        <td colspan="2" class="mainContentMenuFrameSubTop"></td>
      </tr>
      <tr>
        <td colspan="2" align="center" valign="middle" class="mainContentMenuFrameSub"><div id="menuMainSub">
		<form id="mainCharSearch" name="mainCharSearch" method="post" action="http://gearscores.com/character.php" style="display:inline;">Region:&nbsp;<select name="r" id="region2" onchange="updateRealmList(2);"><option value="us" selected="selected">US</option>
          <option value="eu">EU</option></select>&nbsp;Name:&nbsp;<select onchange="javascript:insertChar('name2',this.options[this.selectedIndex].value);this.selectedIndex=0;"><option SELECTED="true" /><option>ß</option><option>à</option><option>á</option><option>â</option><option>ã</option><option>ä</option><option>å</option><option>æ</option><option>ç</option><option>è</option><option>é</option><option>ê</option><option>ë</option><option>ì</option><option>í</option><option>î</option><option>ï</option><option>ð</option><option>ñ</option><option>ò</option><option>ó</option><option>ô</option><option>õ</option><option>ö</option><option>ø</option><option>ù</option><option>ú</option><option>û</option><option>ü</option><option>ý</option><option>ÿ</option></select>&nbsp;<input type="text" name="n" id="name2" />&nbsp;Realm:&nbsp;<div id="divServer2" style="display:inline;"><select name="s" id="server2"><option value="Aegwynn">Aegwynn</option>
<option value="Aerie Peak">Aerie Peak</option>
<option value="Agamaggan">Agamaggan</option>
<option value="Aggramar">Aggramar</option>
<option value="Akama">Akama</option>
<option value="Alexstrasza">Alexstrasza</option>
<option value="Alleria">Alleria</option>
<option value="Altar of Storms">Altar of Storms</option>
<option value="Alterac Mountains">Alterac Mountains</option>
<option value="Aman'Thul">Aman'Thul</option>
<option value="Andorhal">Andorhal</option>
<option value="Anetheron">Anetheron</option>
<option value="Antonidas">Antonidas</option>
<option value="Anub'arak">Anub'arak</option>
<option value="Anvilmar">Anvilmar</option>
<option value="Arathor">Arathor</option>
<option value="Archimonde">Archimonde</option>
<option value="Area 52">Area 52</option>
<option value="Argent Dawn">Argent Dawn</option>
<option value="Arthas">Arthas</option>
<option value="Arygos">Arygos</option>
<option value="Auchindoun">Auchindoun</option>
<option value="Azgalor">Azgalor</option>
<option value="Azjol-Nerub">Azjol-Nerub</option>
<option value="Azshara">Azshara</option>
<option value="Azuremyst">Azuremyst</option>
<option value="Baelgun">Baelgun</option>
<option value="Balnazzar">Balnazzar</option>
<option value="Barthilas">Barthilas</option>
<option value="Black Dragonflight">Black Dragonflight</option>
<option value="Blackhand">Blackhand</option>
<option value="Blackrock">Blackrock</option>
<option value="Blackwater Raiders">Blackwater Raiders</option>
<option value="Blackwing Lair">Blackwing Lair</option>
<option value="Blade's Edge">Blade's Edge</option>
<option value="Bladefist">Bladefist</option>
<option value="Bleeding Hollow">Bleeding Hollow</option>
<option value="Blood Furnace">Blood Furnace</option>
<option value="Bloodhoof">Bloodhoof</option>
<option value="Bloodscalp">Bloodscalp</option>
<option value="Bonechewer">Bonechewer</option>
<option value="Borean Tundra">Borean Tundra</option>
<option value="Boulderfist">Boulderfist</option>
<option value="Bronzebeard">Bronzebeard</option>
<option value="Burning Blade">Burning Blade</option>
<option value="Burning Legion">Burning Legion</option>
<option value="Caelestrasz">Caelestrasz</option>
<option value="Cairne">Cairne</option>
<option value="Cenarion Circle">Cenarion Circle</option>
<option value="Cenarius">Cenarius</option>
<option value="Cho'gall">Cho'gall</option>
<option value="Chromaggus">Chromaggus</option>
<option value="Coilfang">Coilfang</option>
<option value="Crushridge">Crushridge</option>
<option value="Daggerspine">Daggerspine</option>
<option value="Dalaran">Dalaran</option>
<option value="Dalvengyr">Dalvengyr</option>
<option value="Dark Iron">Dark Iron</option>
<option value="Darkspear">Darkspear</option>
<option value="Darrowmere">Darrowmere</option>
<option value="Dath'Remar">Dath'Remar</option>
<option value="Dawnbringer">Dawnbringer</option>
<option value="Deathwing">Deathwing</option>
<option value="Demon Soul">Demon Soul</option>
<option value="Dentarg">Dentarg</option>
<option value="Destromath">Destromath</option>
<option value="Dethecus">Dethecus</option>
<option value="Detheroc">Detheroc</option>
<option value="Doomhammer">Doomhammer</option>
<option value="Draenor">Draenor</option>
<option value="Dragonblight">Dragonblight</option>
<option value="Dragonmaw">Dragonmaw</option>
<option value="Drak'Tharon">Drak'Tharon</option>
<option value="Drak'thul">Drak'thul</option>
<option value="Draka">Draka</option>
<option value="Dreadmaul">Dreadmaul</option>
<option value="Drenden">Drenden</option>
<option value="Dunemaul">Dunemaul</option>
<option value="Durotan">Durotan</option>
<option value="Duskwood">Duskwood</option>
<option value="Earthen Ring">Earthen Ring</option>
<option value="Echo Isles">Echo Isles</option>
<option value="Eitrigg">Eitrigg</option>
<option value="Eldre'Thalas">Eldre'Thalas</option>
<option value="Elune">Elune</option>
<option value="Emerald Dream">Emerald Dream</option>
<option value="Eonar">Eonar</option>
<option value="Eredar">Eredar</option>
<option value="Executus">Executus</option>
<option value="Exodar">Exodar</option>
<option value="Farstriders">Farstriders</option>
<option value="Feathermoon">Feathermoon</option>
<option value="Fenris">Fenris</option>
<option value="Firetree">Firetree</option>
<option value="Fizzcrank ">Fizzcrank </option>
<option value="Frostmane">Frostmane</option>
<option value="Frostmourne">Frostmourne</option>
<option value="Frostwolf">Frostwolf</option>
<option value="Galakrond">Galakrond</option>
<option value="Garithos">Garithos</option>
<option value="Garona">Garona</option>
<option value="Garrosh">Garrosh</option>
<option value="Ghostlands">Ghostlands</option>
<option value="Gilneas">Gilneas</option>
<option value="Gnomeregan">Gnomeregan</option>
<option value="Gorefiend">Gorefiend</option>
<option value="Gorgonnash">Gorgonnash</option>
<option value="Greymane">Greymane</option>
<option value="Grizzly Hills">Grizzly Hills</option>
<option value="Gul'dan">Gul'dan</option>
<option value="Gundrak">Gundrak</option>
<option value="Gurubashi">Gurubashi</option>
<option value="Hakkar">Hakkar</option>
<option value="Haomarush">Haomarush</option>
<option value="Hellscream">Hellscream</option>
<option value="Hydraxis">Hydraxis</option>
<option value="Hyjal">Hyjal</option>
<option value="Icecrown">Icecrown</option>
<option value="Illidan">Illidan</option>
<option value="Jaedenar">Jaedenar</option>
<option value="Jubei'Thos">Jubei'Thos</option>
<option value="Kael'thas">Kael'thas</option>
<option value="Kalecgos">Kalecgos</option>
<option value="Kargath">Kargath</option>
<option value="Kel'Thuzad" selected="selected">Kel'Thuzad</option>
<option value="Khadgar">Khadgar</option>
<option value="Khaz Modan">Khaz Modan</option>
<option value="Khaz'goroth">Khaz'goroth</option>
<option value="Kil'jaeden">Kil'jaeden</option>
<option value="Kilrogg">Kilrogg</option>
<option value="Kirin Tor">Kirin Tor</option>
<option value="Korgath">Korgath</option>
<option value="Korialstrasz">Korialstrasz</option>
<option value="Kul Tiras">Kul Tiras</option>
<option value="Laughing Skull">Laughing Skull</option>
<option value="Lethon">Lethon</option>
<option value="Lightbringer">Lightbringer</option>
<option value="Lightning's Blade">Lightning's Blade</option>
<option value="Lightninghoof">Lightninghoof</option>
<option value="Llane">Llane</option>
<option value="Lothar">Lothar</option>
<option value="Madoran">Madoran</option>
<option value="Maelstrom">Maelstrom</option>
<option value="Magtheridon">Magtheridon</option>
<option value="Maiev">Maiev</option>
<option value="Mal'Ganis">Mal'Ganis</option>
<option value="Malfurion">Malfurion</option>
<option value="Malorne">Malorne</option>
<option value="Malygos">Malygos</option>
<option value="Mannoroth">Mannoroth</option>
<option value="Medivh">Medivh</option>
<option value="Misha">Misha</option>
<option value="Mok'Nathal">Mok'Nathal</option>
<option value="Moon Guard ">Moon Guard </option>
<option value="Moonrunner">Moonrunner</option>
<option value="Mug'thol">Mug'thol</option>
<option value="Muradin">Muradin</option>
<option value="Nagrand">Nagrand</option>
<option value="Nathrezim">Nathrezim</option>
<option value="Nazgrel">Nazgrel</option>
<option value="Nazjatar">Nazjatar</option>
<option value="Ner'zhul">Ner'zhul</option>
<option value="Nesingwary">Nesingwary</option>
<option value="Nordrassil">Nordrassil</option>
<option value="Norgannon">Norgannon</option>
<option value="Onyxia">Onyxia</option>
<option value="Perenolde">Perenolde</option>
<option value="Proudmoore">Proudmoore</option>
<option value="Quel'dorei">Quel'dorei</option>
<option value="Ravencrest">Ravencrest</option>
<option value="Ravenholdt">Ravenholdt</option>
<option value="Rexxar">Rexxar</option>
<option value="Rivendare">Rivendare</option>
<option value="Runetotem">Runetotem</option>
<option value="Sargeras">Sargeras</option>
<option value="Saurfang">Saurfang</option>
<option value="Scarlet Crusade">Scarlet Crusade</option>
<option value="Scilla">Scilla</option>
<option value="Sen'jin">Sen'jin</option>
<option value="Sentinels">Sentinels</option>
<option value="Shadow Council">Shadow Council</option>
<option value="Shadowmoon">Shadowmoon</option>
<option value="Shadowsong">Shadowsong</option>
<option value="Shandris">Shandris</option>
<option value="Shattered Halls">Shattered Halls</option>
<option value="Shattered Hand">Shattered Hand</option>
<option value="Shu'halo">Shu'halo</option>
<option value="Silver Hand">Silver Hand</option>
<option value="Silvermoon">Silvermoon</option>
<option value="Sisters of Elune">Sisters of Elune</option>
<option value="Skullcrusher">Skullcrusher</option>
<option value="Skywall">Skywall</option>
<option value="Smolderthorn">Smolderthorn</option>
<option value="Spinebreaker">Spinebreaker</option>
<option value="Spirestone">Spirestone</option>
<option value="Staghelm">Staghelm</option>
<option value="Steamwheedle Cartel">Steamwheedle Cartel</option>
<option value="Stonemaul">Stonemaul</option>
<option value="Stormrage">Stormrage</option>
<option value="Stormreaver">Stormreaver</option>
<option value="Stormscale">Stormscale</option>
<option value="Suramar">Suramar</option>
<option value="Tanaris">Tanaris</option>
<option value="Terenas">Terenas</option>
<option value="Terokkar">Terokkar</option>
<option value="Thaurissan">Thaurissan</option>
<option value="The Forgotten Coast">The Forgotten Coast</option>
<option value="The Scryers">The Scryers</option>
<option value="The Underbog">The Underbog</option>
<option value="The Venture Co">The Venture Co</option>
<option value="Thorium Brotherhood">Thorium Brotherhood</option>
<option value="Thrall">Thrall</option>
<option value="Thunderhorn">Thunderhorn</option>
<option value="Thunderlord">Thunderlord</option>
<option value="Tichondrius">Tichondrius</option>
<option value="Tortheldrin">Tortheldrin</option>
<option value="Trollbane">Trollbane</option>
<option value="Turalyon">Turalyon</option>
<option value="Twisting Nether">Twisting Nether</option>
<option value="Uldaman">Uldaman</option>
<option value="Uldum">Uldum</option>
<option value="Undermine">Undermine</option>
<option value="Ursin">Ursin</option>
<option value="Uther">Uther</option>
<option value="Vashj">Vashj</option>
<option value="Vek'nilash">Vek'nilash</option>
<option value="Velen">Velen</option>
<option value="Warsong">Warsong</option>
<option value="Whisperwind">Whisperwind</option>
<option value="Wildhammer">Wildhammer</option>
<option value="Windrunner">Windrunner</option>
<option value="Winterhoof">Winterhoof</option>
<option value="Wyrmrest Accord">Wyrmrest Accord</option>
<option value="Ysera">Ysera</option>
<option value="Ysondre">Ysondre</option>
<option value="Zangarmarsh">Zangarmarsh</option>
<option value="Zul'jin">Zul'jin</option>
<option value="Zuluhed">Zuluhed</option></select></div>&nbsp;<input type="submit" name="submit2" id="submit2" value="Search!" /></form></div></td>
      </tr>
      <tr>
        <td colspan="2" class="mainContentMenuFrameSubBottom"></td>
      </tr>
      		<tr>
        <td colspan="2" align="center" valign="middle"><? //include '/home/gearscores/public_html/includes/media/11.php'; ?>&nbsp;</td>
      </tr>		      <tr>
        <td colspan="2" class="mainContentMainTable">
          <div align="center">
            <table border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td><div class="dropshadow2">
                  <table width="600" class="mainTable dropshadow2table" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="70" rowspan="2" align="center" valign="bottom" style="padding-bottom:6px;"><table>
                        <tr>
                          <td><div class="dropshadow3">
                            <table width="70" border="0" align="center" cellpadding="0" cellspacing="0" class="leftGearTable">
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><div class="gearIcon"><a href="http://www.wowhead.com/?item=51435" rel="gems=41382:42144:0&amp;ench=3797&pcs=51433:51434:51435:51436:51437"><img src="http://static.wowhead.com/images/wow/icons/large/inv_helmet_126.jpg" class="gearIconPic" style="border-color: #a335ee;" /><div class="ilvlText">270</div></a></div></td>
                              </tr>
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><div class="gearIcon"><a href="http://www.wowhead.com/?item=51331" rel="gems=0:0:0&amp;ench=0"><img src="http://static.wowhead.com/images/wow/icons/large/inv_jewelry_necklace_36.jpg" class="gearIconPic" style="border-color: #a335ee;" /><div class="ilvlText">264</div></a></div></td>
                              </tr>
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><div class="gearIcon"><a href="http://www.wowhead.com/?item=41282" rel="gems=40113:0:0&amp;ench=3794"><img src="http://static.wowhead.com/images/wow/icons/large/inv_shoulder_107.jpg" class="gearIconPic" style="border-color: #a335ee;" /><div class="ilvlText">251</div></a></div></td>
                              </tr>
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><div class="gearIcon"><a href="http://www.wowhead.com/?item=51330" rel="gems=0:0:0&amp;ench=3243"><img src="http://static.wowhead.com/images/wow/icons/large/inv_misc_cape_20.jpg" class="gearIconPic" style="border-color: #a335ee;" /><div class="ilvlText">264</div></a></div></td>
                              </tr>
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><div class="gearIcon"><a href="http://www.wowhead.com/?item=51433" rel="gems=42144:40155:0&amp;ench=3245"><img src="http://static.wowhead.com/images/wow/icons/large/inv_chest_leather_25.jpg" class="gearIconPic" style="border-color: #a335ee;" /><div class="ilvlText">270</div></a></div></td>
                              </tr>
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><div class="gearIcon"><a href="http://www.wowhead.com/?item=10054" rel="gems=0:0:0&amp;ench=0"><img src="http://static.wowhead.com/images/wow/icons/large/inv_shirt_purple_01.jpg" class="gearIconPic" style="border-color: #ffffff;" /><div class="ilvlText">46</div></a></div></td>
                              </tr>
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><div class="gearIcon"><a href="http://www.wowhead.com/?item=43156" rel="gems=0:0:0&amp;ench=0"><img src="http://static.wowhead.com/images/wow/icons/large/inv_shirt_guildtabard_01.jpg" class="gearIconPic" style="border-color: #ffffff;" /><div class="ilvlText">75</div></a></div></td>
                              </tr>
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><div class="gearIcon"><a href="http://www.wowhead.com/?item=51345" rel="gems=0:0:0&amp;ench=2332"><img src="http://static.wowhead.com/images/wow/icons/large/inv_bracer_57.jpg" class="gearIconPic" style="border-color: #a335ee;" /><div class="ilvlText">264</div></a></div></td>
                              </tr>
                            </table>
                          </div></td>
                        </tr>
                      </table></td>
                      <td align="center" valign="top"><table>
                        <tr>
                          <td><div class="dropshadow4">
                            <table width="410" border="0" cellspacing="0" cellpadding="0" class="charInfo">
                              <tr>
                                <td align="right" valign="top"><table width="400" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td colspan="2" align="right" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td colspan="3" align="center" valign="top"><span class="charInfoPrefix"></span>
                                          <div class="charInfoName" style="color:#DF6A00;"><a href="http://www.wowarmory.com/character-sheet.xml?r=Kel%27Thuzad&cn=Dreamstar">Dreamstar</a></div>
                                          <span class="charInfoSuffix">of the Ashen Verdict</span></td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" align="center" valign="top"><a href="http://www.wowarmory.com/guild-info.xml?r=Kel%27Thuzad&gn=on+nine+or+doesnt+matter">                                          <span class="charInfoGuild">
                                            &lt;on nine or doesnt matter&gt;                                            </span>
                                          </a>                                          &nbsp;</td>
                                      </tr>                                      <tr>
                                        <td width="75" align="right" valign="middle"><img src="http://gearscores.com/images/icons/race/Ui-charactercreate-races_nightelf-female.png" height="64" width="64" /></td>
                                        <td align="center" valign="middle"><span class="charInfoLevel">80</span> <span class="charInfoRace">Night Elf</span> <span class="charInfoClass" style="color:#DF6A00;">Druid</span><br />
                                          <span class="charInfoRealmText">Realm: </span><span class="charInfoRealm">Kel'Thuzad</span><br />
                                          <span class="charInfoBGText">Battlegroup: </span><span class="charInfoBG">Nightfall</span></td>
                                        <td width="70" align="left" valign="middle"><img src="http://gearscores.com/images/icons/class/UI-CharacterCreate-Classes_Druid.png" height="64" width="64" /></td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" align="center" valign="top"><table>
                                          <tr>
                                            <td><div class="dropshadow5">
                                              <table border="0" cellspacing="0" cellpadding="0" class="dropshadow5table gsColorTable">
                                                <tr>
                                                  <td class="rowA" align="center" valign="middle">GearScore</td>
                                                </tr>
                                                <tr>
                                                  <td class="rowB" valign="middle" align="center" style="color:#FE0000;font-size:35px;">5994</td>
                                                </tr>
                                                                                              <tr>
                                                <td class="rowD" valign="middle" align="center">Highest: <a href="javascript:postToURL('http://gearscores.com/character.php', {'n':'Dreamstar','s':'Kel\'Thuzad','r':'us','cm':'gs'});"><span style="color:#FF0000;font-size:14px;">6013</span></a></td>
                                              </tr>
                                                <tr>
                                                  <td class="rowC" valign="middle" align="center">Avg ilvl: 260</td>
                                                </tr>
                                              </table>
                                            </div></td>
                                          </tr>
                                        </table></td>
                                      </tr>
                                    <tr>
                                        <td colspan="3" align="center" valign="top"><table><tr><td><a href="http://www.wowarmory.com/character-model-embed.xml?r=Kel%27Thuzad&cn=Dreamstar&rhtml=true" target="_blank"><img src="http://gearscores.com/images/view3d.png" class="view3dButton" /></a>&nbsp;&nbsp;&nbsp;<a href="http://gearscores.com/signature.php?n=Dreamstar&s=Kel%27Thuzad&r=us"><img src="http://gearscores.com/images/genSig.png" class="view3dButton" width="139" height="39" /></a></td></tr></table>
                                        </td>
                                    </tr>
                                      </tr>
                                    </table></td>
                                  </tr>
                                  <tr>
                                    <td colspan="2" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td width="50%" align="center" valign="top"><table><tr><td><div class="dropshadow"><table width="150" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					  <td align="center" valign="middle" class="activeTalentRowA">Active</td>
					</tr>
					<tr>
					  <td align="center" valign="middle" class="activeTalentRowB"><a href="http://www.wowarmory.com/character-talents.xml?r=Kel%27Thuzad&cn=Dreamstar&group=2">Balance</a></td>
					</tr>
					<tr>
					  <td align="center" valign="middle" class="activeTalentRowC"><a href="http://www.wowarmory.com/character-talents.xml?r=Kel%27Thuzad&cn=Dreamstar&group=2">55/0/16</a></td>
					</tr>
				  </table></div></td></tr></table></td>
				<td width="50%" align="center" valign="top"><table>
				  <tr>
					<td><div class="dropshadow">
					  <table width="150" border="0" cellspacing="0" cellpadding="0">
						<tr>
						  <td align="center" valign="middle" class="inactiveTalentRowA"><a href="javascript:postToURL('http://gearscores.com/character.php', {'n':'Dreamstar','s':'Kel\'Thuzad','r':'us','cm':'1'});">Inactive - (View)</a></td>
						</tr>
						<tr>
						  <td align="center" valign="middle" class="inactiveTalentRowB"><a href="http://www.wowarmory.com/character-talents.xml?r=Kel%27Thuzad&cn=Dreamstar&group=1">Restoration</a></td>
						</tr>
						<tr>
						  <td align="center" valign="middle" class="inactiveTalentRowC"><a href="http://www.wowarmory.com/character-talents.xml?r=Kel%27Thuzad&cn=Dreamstar&group=1">21/0/50</a></td>
						</tr>
					  </table>
					</div></td>
				  </tr>
				</table></td>
			  </tr>
			</table></td>
                                  </tr>
                                  <tr>
                                    <td width="50%" align="center" valign="top"><table>
                                      <tr>
                                        <td><div class="dropshadow5"><table class="dropshadow5table mainHealthTable"><tr><td align="center" valign="middle"><table><tr><td class="rowA">Health</td></tr><tr><td class="healthBarTable">30137</td></tr><tr><td class="rowA">Mana</td></tr><tr><td class="manaBarTable" style="background-color:#0000FF;color:white;">19401</td></tr></table></td></tr></table></div></td>
                                      </tr>
                                    </table></td>
                                    <td width="50%" align="center" valign="top"><table>
                                      <tr>
                                        <td><div class="dropshadow5"><table class="dropshadow5table mainProfTable"><tr><td align="center" valign="middle"><table><tr><td class="rowA">Alchemy</td></tr><tr><td class="profBarTable"><div class="profBar" style="width:100px;"><div class="profBarText">450/450</div></div></td></tr></table><table><tr><td class="rowA">Jewelcrafting</td></tr><tr><td class="profBarTable"><div class="profBar" style="width:100px;"><div class="profBarText">450/450</div></div></td></tr></table></td></tr></table></div></td>
                                      </tr>
                                    </table></td>
                                  </tr>
                                </table></td>
                              </tr>
                            </table>
                          </div></td>
                        </tr>
                      </table></td>
                      <td width="70" rowspan="2" align="center" valign="bottom" style="padding-bottom:6px;"><table>
                        <tr>
                          <td><div class="dropshadow3">
                            <table width="70" border="0" cellpadding="0" cellspacing="0" class="rightGearTable">
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><div class="gearIcon"><a href="http://www.wowhead.com/?item=51434" rel="gems=40113:0:0&amp;ench=3246"><img src="http://static.wowhead.com/images/wow/icons/large/inv_gauntlets_77b.jpg" class="gearIconPic" style="border-color: #a335ee;" /><div class="ilvlText">270</div></a></div></td>
                              </tr>
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><div class="gearIcon"><a href="http://www.wowhead.com/?item=51343" rel="gems=40135:40113:0&amp;ench=0&amp;sock"><img src="http://static.wowhead.com/images/wow/icons/large/inv_belt_46.jpg" class="gearIconPic" style="border-color: #a335ee;" /><div class="ilvlText">264</div></a></div></td>
                              </tr>
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><div class="gearIcon"><a href="http://www.wowhead.com/?item=51422" rel="gems=42144:40135:0&amp;ench=3721"><img src="http://static.wowhead.com/images/wow/icons/large/inv_pants_leather_27.jpg" class="gearIconPic" style="border-color: #a335ee;" /><div class="ilvlText">270</div></a></div></td>
                              </tr>
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><div class="gearIcon"><a href="http://www.wowhead.com/?item=51344" rel="gems=40152:0:0&amp;ench=3232"><img src="http://static.wowhead.com/images/wow/icons/large/inv_boots_cloth_05.jpg" class="gearIconPic" style="border-color: #a335ee;" /><div class="ilvlText">264</div></a></div></td>
                              </tr>
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><div class="gearIcon"><a href="http://www.wowhead.com/?item=50398" rel="gems=40152:0:0&amp;ench=3840"><img src="http://static.wowhead.com/images/wow/icons/large/inv_jewelry_ring_83.jpg" class="gearIconPic" style="border-color: #a335ee;" /><div class="ilvlText">277</div></a></div></td>
                              </tr>
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><div class="gearIcon"><a href="http://www.wowhead.com/?item=51336" rel="gems=0:0:0&amp;ench=3840"><img src="http://static.wowhead.com/images/wow/icons/large/inv_jewelry_ring_60.jpg" class="gearIconPic" style="border-color: #a335ee;" /><div class="ilvlText">264</div></a></div></td>
                              </tr>
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><div class="gearIcon"><a href="http://www.wowhead.com/?item=46081" rel="gems=0:0:0&amp;ench=0"><img src="http://static.wowhead.com/images/wow/icons/large/inv_misc_rune_10.jpg" class="gearIconPic" style="border-color: #a335ee;" /><div class="ilvlText">213</div></a></div></td>
                              </tr>
                              <tr>
                                <td width="70" height="70" align="center" valign="middle"><div class="gearIcon"><a href="http://www.wowhead.com/?item=42137" rel="gems=0:0:0&amp;ench=0"><img src="http://static.wowhead.com/images/wow/icons/large/ability_warrior_endlessrage.jpg" class="gearIconPic" style="border-color: #a335ee;" /><div class="ilvlText">245</div></a></div></td>
                              </tr>
                            </table>
                          </div></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td align="center" valign="bottom"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td align="center" valign="middle"><table>
                            <tr>
                              <td><div class="dropshadow3">
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="bottomGearTable">
                                  <tr>
                                    <td width="100" height="70" align="center" valign="middle"><div class="gearIcon"><a href="http://www.wowhead.com/?item=51406" rel="gems=40135:0:0&amp;ench=3834"><img src="http://static.wowhead.com/images/wow/icons/large/inv_weapon_shortblade_107.jpg" class="gearIconPic" style="border-color: #a335ee;" /><div class="ilvlText">264</div></a></div></td>
                                    <td width="100" height="70" align="center" valign="middle"><div class="gearIcon"><a href="http://www.wowhead.com/?item=51407" rel="gems=0:0:0&amp;ench=0"><img src="http://static.wowhead.com/images/wow/icons/large/inv_misc_book_06.jpg" class="gearIconPic" style="border-color: #a335ee;" /><div class="ilvlText">270</div></a></div></td>
                                    <td width="100" height="70" align="center" valign="middle"><div class="gearIcon"><a href="http://www.wowhead.com/?item=47671" rel="gems=0:0:0&amp;ench=0"><img src="http://static.wowhead.com/images/wow/icons/large/inv_relics_idolofrejuvenation.jpg" class="gearIconPic" style="border-color: #a335ee;" /><div class="ilvlText">245</div></a></div></td>
                                  </tr>
                                </table>
                              </div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td colspan="3" align="center" valign="middle"><table>
                        <tr>
                          <td><div class="dropshadow4">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="charInfo">
                              <tr>
                                <td width="200" align="center" valign="top"><table border="0" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td><div class="dropshadow">
                                      <table width="150" border="0" cellpadding="0" cellspacing="0" class="statsTable">
                                        <tr class="rowA">
                                          <td colspan="2" align="center" valign="middle">Stats</td>
                                        </tr>
                                        <tr class="rowB">
                                          <td width="100" align="left" valign="middle">Strength:</td>
                                          <td width="50" align="right" valign="middle">152</td>
                                        </tr>
                                        <tr class="rowB">
                                          <td align="left" valign="middle">Agility:</td>
                                          <td align="right" valign="middle">139</td>
                                        </tr>
                                        <tr class="rowB">
                                          <td align="left" valign="middle">Stamina:</td>
                                          <td align="right" valign="middle">2290</td>
                                        </tr>
                                        <tr class="rowB">
                                          <td align="left" valign="middle">Intellect:</td>
                                          <td align="right" valign="middle">1079</td>
                                        </tr>
                                        <tr class="rowB">
                                          <td align="left" valign="middle">Spirit:</td>
                                          <td align="right" valign="middle">322</td>
                                        </tr>
                                      </table>
                                    </div></td>
                                  </tr>
                                </table>
                                  <table border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td><div class="dropshadow">
                                        <table width="150" border="0" cellpadding="0" cellspacing="0" class="defenseTable">
                                          <tr class="rowA">
                                            <td colspan="2" align="center" valign="middle">Defense</td>
                                          </tr>
                                          <tr class="rowB">
                                            <td width="100" align="left" valign="middle">Armor:</td>
                                            <td width="50" align="right" valign="middle">20236</td>
                                          </tr>
                                          <tr class="rowB">
                                            <td align="left" valign="middle">Defense:</td>
                                            <td align="right" valign="middle">400</td>
                                          </tr>
                                          <tr class="rowB">
                                            <td align="left" valign="middle">Dodge:</td>
                                            <td align="right" valign="middle">8.54%</td>
                                          </tr>
                                          <tr class="rowB">
                                            <td align="left" valign="middle">Parry:</td>
                                            <td align="right" valign="middle">0.00%</td>
                                          </tr>
                                          <tr class="rowB">
                                            <td align="left" valign="middle">Block:</td>
                                            <td align="right" valign="middle">0.00%</td>
                                          </tr>
                                          <tr class="rowB">
                                            <td align="left" valign="middle">Resilience:</td>
                                            <td align="right" valign="middle">1,161</td>
                                          </tr>
                                        </table>
                                      </div></td>
                                    </tr>
                                  </table></td>
                                <td width="200" align="center" valign="top"><table border="0" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td><div class="dropshadow">
                                      <table width="150" border="0" cellpadding="0" cellspacing="0" class="spellTable">
                                        <tr class="rowA">
                                          <td colspan="2" align="center" valign="middle">Spell</td>
                                        </tr>
                                        <tr class="rowB">
                                          <td width="100" align="left" valign="middle">Bonus Dmg:</td>
                                          <td width="50" align="right" valign="middle">3664</td>
                                        </tr>
                                        <tr class="rowB">
                                          <td align="left" valign="middle">Bonus Heal:</td>
                                          <td align="right" valign="middle">3568</td>
                                        </tr>
                                        <tr class="rowB">
                                          <td align="left" valign="middle">Hit:</td>
                                          <td align="right" valign="middle">1.94%</td>
                                        </tr>
                                        <tr class="rowB">
                                          <td align="left" valign="middle">Crit:</td>
                                          <td align="right" valign="middle">29.45%</td>
                                        </tr>
                                        <tr class="rowB">
                                          <td align="left" valign="middle">Haste:</td>
                                          <td align="right" valign="middle">7.45%</td>
                                        </tr>
                                        <tr class="rowB">
                                          <td align="left" valign="middle">Mana Regen:</td>
                                          <td align="right" valign="middle">220</td>
                                        </tr>
                                        <tr class="rowB">
                                          <td align="left" valign="middle">Spell Pen:</td>
                                          <td align="right" valign="middle">74</td>
                                        </tr>
                                      </table>
                                    </div></td>
                                  </tr>
                                </table></td>
                                <td width="200" align="center" valign="top"><table border="0" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td><div class="dropshadow">
                                      <table width="150" border="0" cellpadding="0" cellspacing="0" class="meleeTable">
                                        <tr class="rowA">
                                          <td colspan="2" align="center" valign="middle">Melee</td>
                                        </tr>
                                        <tr class="rowB">
                                          <td width="100" align="left" valign="middle">Atk Power:</td>
                                          <td width="50" align="right" valign="middle">1552</td>
                                        </tr>
                                        <tr class="rowB">
                                          <td align="left" valign="middle">Hit:</td>
                                          <td align="right" valign="middle">1.56%</td>
                                        </tr>
                                        <tr class="rowB">
                                          <td align="left" valign="middle">Crit:</td>
                                          <td align="right" valign="middle">9.46%</td>
                                        </tr>
                                        <tr class="rowB">
                                          <td align="left" valign="middle">Haste:</td>
                                          <td align="right" valign="middle">7.45%</td>
                                        </tr>
                                        <tr class="rowB">
                                          <td align="left" valign="middle">Armor Pen:</td>
                                          <td align="right" valign="middle">0.00%</td>
                                        </tr>
                                        <tr class="rowB">
                                          <td align="left" valign="middle">Expertise:</td>
                                          <td align="right" valign="middle">0</td>
                                        </tr>
                                      </table>
                                    </div></td>
                                  </tr>
                                </table>
                                  <table border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td><div class="dropshadow">
                                        <table width="150" border="0" cellpadding="0" cellspacing="0" class="rangedTable">
                                          <tr class="rowA">
                                            <td colspan="2" align="center" valign="middle">Ranged</td>
                                          </tr>
                                          <tr class="rowB">
                                            <td width="100" align="left" valign="middle">Atk Power:</td>
                                            <td width="50" align="right" valign="middle">209</td>
                                          </tr>
                                          <tr class="rowB">
                                            <td align="left" valign="middle">Hit:</td>
                                            <td align="right" valign="middle">1.56%</td>
                                          </tr>
                                          <tr class="rowB">
                                            <td align="left" valign="middle">Crit</td>
                                            <td align="right" valign="middle">9.42%</td>
                                          </tr>
                                          <tr class="rowB">
                                            <td align="left" valign="middle">Armor Pen:</td>
                                            <td align="right" valign="middle">0.00%</td>
                                          </tr>
                                        </table>
                                      </div></td>
                                    </tr>
                                  </table></td>
                              </tr>
                            </table>
                          </div></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td colspan="3" align="center" valign="middle"><table>
                        <tr>
                          <td><div class="dropshadow4" id="charExp1">
                                <table border="0" cellspacing="0" cellpadding="0" class="charInfo" onclick="getRaidExp();">
                                  <tr>
                                    <td align="center" valign="top"><table border="0" cellpadding="0" cellspacing="0">
                                          <tr>
                                            <td><div class="dropshadow">
                                              <table border="0" cellpadding="0" cellspacing="0">
                                                <tr>
                                                  <td colspan="2" align="center" valign="middle" class="busyText">Click here to view raid experience.<br /><img src="images/cauldron.png" width="32" height="32" /></td>
                                                </tr>
                                                </table>
                                            </div></td>
                                          </tr>
                                        </table></td>
                                  </tr>
                                </table>                          
            				</div></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td colspan="3" align="center" valign="middle"><table>
                        <tr>
                          <td><div class="dropshadow4"><table width="200" border="0" cellspacing="0" cellpadding="0" class="charInfo">
              <tr>
                <td width="200" align="center" valign="top"><table border="0" cellpadding="0" cellspacing="0">
					  <tr>
						<td><div class="dropshadow">
						  <table width="150" border="0" cellpadding="0" cellspacing="0" class="arenaTeamTable">
							<tr class="rowA" style="background-color:#fffee0;color:#000000;">
							  <td width="150" colspan="2" align="center" valign="middle"><a href="http://www.wowarmory.com/team-info.xml?r=Kel%27Thuzad&ts=2&t=Pwn+Stuff&select=Pwn+Stuff">Pwn Stuff</a></td>
							</tr>
							<tr class="rowB">
							  <td width="150" colspan="2" align="center" valign="middle"><a href="http://www.wowarmory.com/team-info.xml?r=Kel%27Thuzad&ts=2&t=Pwn+Stuff&select=Pwn+Stuff">2002</a></td>
							</tr>
							<tr class="rowC">
							  <td width="150" colspan="2" align="center" valign="middle"><a href="http://www.wowarmory.com/team-info.xml?r=Kel%27Thuzad&ts=2&t=Pwn+Stuff&select=Pwn+Stuff"><span class="teamSizeText">2v2</span></a></td>
							</tr>
							</table>
						</div></td>
					  </tr>
					</table></td>
              </tr>
            </table></div></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td colspan="3" align="center" valign="middle">
                      <table><tr><td align="center">
                          <div class="dropshadow4">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="commentsTable">
								                            <tr>
									<td>
										<table width="550" border="0" cellspacing="0" cellpadding="0" align="center">
											<tr>
												<td><div class="noComments">No Comments</div></td>
											</tr>
											</td></tr><tr><td><hr />
<table width="550" border="0" cellspacing="0" cellpadding="0" align="left">
<tr>
<td align="center" class="commentTitle">Leave a Comment</td>
</tr>
<tr>
<td align="center"><form id="comments1" name="comments1" method="post" action="http://gearscores.com/includes/postComment.php">
<span class="commentComment"><br />
  Comment: &nbsp;&nbsp;&nbsp;&nbsp;<span id="comments1countdown">0</span>/500 characters used.<br />
  <label>
    <textarea name="comment" id="comments1comment" cols="45" rows="5"  onKeyDown="limitText(this.form.comments1comment,'comments1countdown',500);" 
onKeyUp="limitText(this.form.comments1comment,'comments1countdown',500);"></textarea>
  </label></span>
  <br /><br />
  <input type="hidden" name="n" value="Dreamstar">
  <input type="hidden" name="s" value="Kel'Thuzad">
  <input type="hidden" name="r" value="us">
  <input type="submit" name="button" id="button" value="Submit" />
  <input type="reset" name="reset" id="reset" value="Reset" />
  <br />
</form></td>
</tr>
</table>
										</table>
									</td>
								</tr>
	                          </table>
                          </div>   
                      </td></tr></table><span class="lastModified">Profile updated: August 15, 2010.</span><br />                      </td>
                    </tr>
                  </table>
                </div></td>
              </tr>
              <tr>
              </tr>
            </table>
<!-- Begin: AdBrite, Generated: 2010-07-16 22:03:25  -->
<script type="text/javascript">
var AdBrite_Title_Color = '0000FF';
var AdBrite_Text_Color = '000000';
var AdBrite_Background_Color = 'f5e9d2';
var AdBrite_Border_Color = 'CCCCCC';
var AdBrite_URL_Color = '008000';
try{var AdBrite_Iframe=window.top!=window.self?2:1;var AdBrite_Referrer=document.referrer==''?document.location:document.referrer;AdBrite_Referrer=encodeURIComponent(AdBrite_Referrer);}catch(e){var AdBrite_Iframe='';var AdBrite_Referrer='';}
</script>
<span style="white-space:nowrap;"><script type="text/javascript">document.write(String.fromCharCode(60,83,67,82,73,80,84));document.write(' src="http://ads.adbrite.com/mb/text_group.php?sid=1698399&zs=3732385f3930&ifr='+AdBrite_Iframe+'&ref='+AdBrite_Referrer+'" type="text/javascript">');document.write(String.fromCharCode(60,47,83,67,82,73,80,84,62));</script>
<a target="_top" href="http://www.adbrite.com/mb/commerce/purchase_form.php?opid=1698399&afsid=1"><img src="http://files.adbrite.com/mb/images/adbrite-your-ad-here-leaderboard.gif" style="background-color:#CCCCCC;border:none;padding:0;margin:0;" alt="Your Ad Here" width="14" height="90" border="0" /></a></span>
<!-- End: AdBrite --><br /><table><tr>
  <td class="bottomLinks"><a href="http://gearscores.com/">Home</a> | <a href="http://gearscores.com/character.php">Character Search</a> | <a href="http://gearscores.com/rankings.php">Rankings</a> | <a href="http://gearscores.com/contactUs.php">Contact us</a> | <a href="http://gearscores.com/privacyPolicy.php">Privacy Policy</a></td></tr></table>
          </div>
</td>
      </tr>
    </table></td>
    <td width="28" align="center" valign="middle" class="borderFrameRight"></td>
    </tr>
  <tr>
    <td colspan="3" align="center" valign="middle" class="borderFrameBottom"></td>
    </tr>
</table>
</div>
<div align="center">
<div align="center" class="copyrightInfo">World of Warcraft and Blizzard Entertainment are trademarks or registered trademarks of Blizzard Entertainment, Inc. in the U.S. and/or other countries. These terms and all related materials, logos, and images are copyright &copy; Blizzard Entertainment. This site is in no way associated with or endorsed by Blizzard Entertainment&copy;.
</div></div>
</body>
</html>