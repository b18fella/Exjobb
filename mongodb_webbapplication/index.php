<!DOCTYPE html>
<html>
<head>
        <title>COVID-19 data using MongoDB</title>
        <link rel="stylesheet" href="../main.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="../dataHandling.js"></script>
    </head>
    <body>
        <header>
            <div id="logo">MongoDB</div>
            <ul>
                <a href="#covid-19-data"><li>COVID-19 Data</li></a>
                <a href="#info"><li>Info</li></a>
                <a href="#cc"><li>CC</li></a>
            </ul>
        </header>
        <section id="covid-19-data">
            <form>
                <select name="WHO_region" id="selection">
                    <option value="EMRO" name='WHO_region'>Eastern Mediterranean Region</option>
                    <option value="EURO" name='WHO_region'>European Region</option>
                    <option value="AFRO" name='WHO_region'>African Region</option>
                    <option value="WPRO" name='WHO_region'>Western Pacific Region</option>
                    <option value="AMRO" name='WHO_region'>Region of the Americas</option>
                    <option value="SEARO" name='WHO_region'>South-East Asia Region</option>
                    <option value="Other" name='WHO_region'>Other</option>
                    <option value="ALL" name='WHO_region'>All regions</option>
                </select>
                <button type="button" onclick="getData(false);">Get Data!</button>
                <input type="number" id="iterate">
                <button type="button" onclick="getData(true);">Run tests!</button>
            </form>
            <div id="covidDataContainer">
                <canvas id="covidChart"></canvas>
            </div>
        </section>
        <section id="info">
            <p>Denna webbapplikation har tagits fram för att undersöka vilket databas som är mest effektiv i att hämta COVID-19 data.</p>
            <p>Denna webbapplikation är då gjord för MySQL. Det finns även en till som är nästan helt identisk som då är för MongoDB.</p>
        </section>
        <section id="cc">
            <p>All den data som används inom dessa applikationer kommer från World Health Organsation. All publicerad data från WHO är även skyddat med Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Intergovernmental Organization licence, även kallad <a href="https://creativecommons.org/licenses/by-nc-sa/3.0/igo/">CC BY-NC-SA 3.0 IGO</a></p>
        </section>
    </body>
</html>