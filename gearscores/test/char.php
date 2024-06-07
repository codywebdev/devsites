<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GearScores.com - WoW Armory Profiles</title>
<meta name="keywords" content="gearscore, gearscores, wow, warcraft, gear score, gear scores, gear, score, scores, armory, games, gaming, game, mmo, mmorpg, rpg, role playing game, role playing">
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
            	<td align="left"><a href="http://gearscores.com/index.php">Permanent Link</a></td>
        		<td align="right"><form id="topLogin" name="topLogin" method="post" action="http://gearscores.com/login.php">Email: <input name="loginE" type="text" id="topLoginE" size="15" maxlength="100"/> Password: <input name="loginP" type="password" id="topLoginP" size="15" maxlength="32"/>
        <input type="submit" name="submit" id="submit" value="Log In" />
    </form></td>
    		</tr>
        </table>
    </td>
    <td width="20" align="center" valign="middle"></td>
  </tr>
  <tr>
    <td width="180" rowspan="3" align="left" valign="top" class="borderFrameLeftShadow"><img src="http://gearscores.com/images/160px-blank.png" width="120" height="400" /><script type="text/javascript"><!--
google_ad_client = "pub-2953976509210050";
/* GearScores - 120x600 Text and Images B/W */
google_ad_slot = "7512131286";
google_ad_width = 120;
google_ad_height = 600;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></td>
    <td colspan="3" align="center" valign="middle" class="borderFrameTop"></td>
    <td width="180" rowspan="3" align="right" valign="top" class="borderFrameRightShadow"><img src="http://gearscores.com/images/160px-blank.png" width="120" height="400" /></td>
  </tr>
  <tr>
    <td width="28" align="center" valign="middle" class="borderFrameLeft"><img src="http://gearscores.com/images/160px-blank.png" width="28" height="1" /></td>
    <td align="center" valign="middle" class="borderFrameMainTable"><table border="0" align="center" cellpadding="0" cellspacing="0" class="mainContent">
      <tr>
        <td colspan="2" class="mainContentTopSearch"></td>
      </tr>
                <tr>
                	<td colspan="5" style="vertical-align:bottom;text-align:center;background-color:black;">                    </td>
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
            		<td width="750">&nbsp;</td>
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
                <td width="50" align="center" valign="middle" class="active" id="menuHome"><a href="http://gearscores.com">Home</a></td>
                <td width="2" align="center" valign="middle" class="menuSpacer" id="menuSpacer"></td>
                <td width="145" align="center" valign="middle" class="inactive" id="menuSearch"><a href="http://gearscores.com/character.php">Character Search</a></td>
                <td width="2" align="center" valign="middle" class="menuSpacer" id="menuSpacer"></td>
                <td width="75" align="center" valign="middle" class="inactive" id="menuRankings"><a href="http://gearscores.com/rankings.php">Rankings</a></td>
                <td width="2" align="center" valign="middle" class="menuSpacer" id="menuSpacer"></td>
                <td width="50" align="center" valign="middle" class="inactive" id="menuRankings"><a href="http://gearscores.com/login.php">Log In</a></td>
                <td width="2" align="center" valign="middle" class="menuSpacer" id="menuSpacer"></td>
                <td width="110" align="center" valign="middle" class="inactive" id="menuRankings"><a href="http://gearscores.com/contest.php"><img src="http://gearscores.com/images/commentandwin2.png" width="110" height="40" style="border-style:none;" /></a></td>
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
		Welcome to GearScores.com!</div></td>
      </tr>
      <tr>
        <td colspan="2" class="mainContentMenuFrameSubBottom"></td>
      </tr>
      		<tr>
        <td colspan="2" align="center" valign="middle">&nbsp;</td>
      </tr>		      <tr>
        <td colspan="2" class="mainContentMainTable">
          <div align="center">            <table border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td><div class="dropshadow2">
                  <table class="homeMainTable dropshadow2table" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="center" valign="top">
                      <table border="0" cellspacing="0" cellpadding="0"><tr><td>
                      <div class="dropshadow4">
                          <table border="0" cellspacing="0" cellpadding="0" class="commentsTable">
								                            <tr>
										<td align="center" colspan="3"><table><tr><td>
                                        <div class="dropshadow">
											<form id="mainpageSearch" name="mainpageSearch" method="post" action="http://gearscores.com/character.php" style="display:inline;"><table border="0" cellspacing="0" cellpadding="0" class="mainpageSearch">
												<tr>
													<td align="center" class="rowD" colspan="2">Character Search</td></tr><tr>
													<td align="left" class="rowA" colspan="2">
                                                    
                                                    Name: <input type="text" name="n" id="name3" /> <select onchange="javascript:insertChar('name3',this.options[this.selectedIndex].value);this.selectedIndex=0;"><option SELECTED="true" /><option>ß</option><option>à</option><option>á</option><option>â</option><option>ã</option><option>ä</option><option>å</option><option>æ</option><option>ç</option><option>è</option><option>é</option><option>ê</option><option>ë</option><option>ì</option><option>í</option><option>î</option><option>ï</option><option>ð</option><option>ñ</option><option>ò</option><option>ó</option><option>ô</option><option>õ</option><option>ö</option><option>ø</option><option>ù</option><option>ú</option><option>û</option><option>ü</option><option>ý</option><option>ÿ</option></select>
                                                    </td></td></tr>
                                                        <tr>
                                                        <td align="left" class="rowB region3">Region: <select name="r" id="region3" onchange="updateRealmList(3);" class="region3">
                                                          <option value="us" selected="selected">US</option>
																  <option value="eu">EU</option>                                                        </select></td><td align="left" class="rowB server3">Realm: 
                                                        <div id="divServer3" style="display:inline;"><select name="s" id="server3" class="server3">
                                                          <option value="Aegwynn">Aegwynn</option>
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
<option value="Zuluhed">Zuluhed</option>                                                        </select></div></td></tr></td><td align="center" colspan="2" class="rowC">
                                                        <input type="submit" name="submit" id="submit" value="Search!" />
                                                   
                                                   		</tr>
                                                   </td>

												</tr></table></form>
										</td></tr></table></div></td>
            <!--<tr><td align="center">
            <table width="300" border="0" cellspacing="0" cellpadding="0" class="errorTable">
              <tr>
                <td align="center" valign="middle" width="20"><img src="http://gearscores.com/images/warn.png" /></td><td align="center" valign="middle"> 
             Character Search is functional again.  Some stats may not display correctly (WoW Armory bug).
             </td>
              </tr>
            </table>
            </td></tr>-->
                                    <tr>
                                    	<td colspan="3" style="text-align:center;"><hr /><br /><a href="http://wow.curse.com/downloads/wow-addons/details/gearscore.aspx"><img src="../images/downloadGS.png" width="150" height="44" style="border-style: none" /></a>&nbsp;&nbsp;&nbsp;<a href="http://wow.curse.com/downloads/wow-addons/details/gearscorelite.aspx"><img src="../images/downloadGSL.png" width="150" height="44" style="border-style: none" /></a><br /><br />
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td colspan="3" style="text-align:center;">
                                        <div align="center"><table><tr><td>
                                        <div class="dropshadow">
                                        <table border="0" cellspacing="0" cellpadding="0" width="400">
                                            <tr>
                                                <td class="featuresText" style="text-align:center;"><a href="http://gearscores.com/contest.php"><img src="http://gearscores.com/images/commentandwin.png" width="306" height="256" style="border-style:none;" /></a>
                                                </td>
                                            </tr>
                                        </table>
                                        </div>
                                        </td></tr></table></div>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td colspan="3">
                                        <div class="dropshadow">
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td class="featuresText" style="text-align:center;"><h1>GearScore Explained</h1>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="featuresText" style="text-align:left;">
                                                GearScore is a way of calculating how powerful a players gear is based on how Blizzard (the creators of World of Warcraft) itemizes all of the items in the game.  A level 80 sword will have a higher GearScore than a level 50 sword.  A level 80 epic (purple) sword will have a higher GearScore than a level 80 rare (blue) sword.  <br />
        <br />
        Blizzard is constantly releasing new content and even harder raid dungeons for players to explore.  With each new dungeon comes even more powerful items.  Each item in the game has an "item level" (ilvl) attached to it.  The item level describes how powerful that item is compared to other items that fit into the same slot.  So an item level 200 bracer will be more powerful than an item level 100 bracer.<br />
        <br />
        Itemizing is a term that is used to describe how Blizzard adds attribute points to an item usually referred to as an item's "stats".  A mage might want some intellect while a warrior would want strength.  The higher the item level, then the more of an attribute Blizzard can itemize to an item.  So an item level 100 bracer might have 20 strength while an item level 200 bracer might have 50 strength.  So the player with an item level 200 bracer would have a more powerful bracer on their wrist than the player with an item level 100 bracer.<br />
        <br />
        Each equipment slot has a different weighted value to it for attributes.  So an item level 200 bracer might have 50 strength and an item level 200 sword might have 100 strength.  This is what you might expect since a magical sword would be much more vital to a warriors success, than a magical bracer.<br />
        <br />
        Taking in the item level, rarity of an item (uncommon, rare, epic, etc), slot the item is used in, GearScores.com calculates a number that estimates the power of each item, then adds up each item a player is wearing to create a players GearScore.  A player with a GearScore of 6000 would be capable of performing better than an equally skilled player with a GearScore of 5000.  <br />
        <br />
        It is important to understand that the skill level of a player is a very important factor in how well they perform in a raid or dungeon.  A very skilled player with a 5000 GearScore could outperform a much less skilled player that has a higher GearScore.  
        
                                                </td>
                                            </tr>
                                        </table>
                                        </div>
                                        </td>
                                    </tr>
                          </table>
                      </div>
                      </td></tr></table>
                      </td>
                    </tr>
                  </table>
                </div></td>
              </tr>
            </table>
<script type="text/javascript"><!--
google_ad_client = "pub-2953976509210050";
google_ad_slot = "6536471111";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script><br /><table><tr>
  <td class="bottomLinks"><a href="http://gearscores.com/">Home</a> | <a href="http://gearscores.com/character.php">Character Search</a> | <a href="http://gearscores.com/rankings.php">Rankings</a> | <a href="http://gearscores.com/contactUs.php">Contact us</a> | <a href="http://gearscores.com/privacyPolicy.php">Privacy Policy</a></td></tr></table>
          </div>
</td>
      </tr>
    </table></td>
    <td width="28" align="center" valign="middle" class="borderFrameRight"><img src="http://gearscores.com/images/160px-blank.png" width="28" height="1" /></td>
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

<!--Array
(
    [start] => 1288919809.560375
    [includes] => 0.02036213874816895
    [bottom_showAds2] => 0.1385951042175293
    [bottom_showAds2_mem] => 1144128
    [bottom_midHtml] => 0.1386270523071289
    [bottom_preCloseDB] => 0.1386399269104004
    [bottom_preCloseDB_mem] => 1144576
    [bottom_closeDB] => 0.1390390396118164
    [end] => 0.1390540599822998
)
-->