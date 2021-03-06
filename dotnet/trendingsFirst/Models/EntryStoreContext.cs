using System;
using System.Collections.Generic;
using System.Globalization;
using System.Linq;
using MySql.Data.MySqlClient;
using Trendings.Context;
    
namespace Trendings.Models
{    
    public class EntryStoreContext
    {
        private string connectionString;

        public EntryStoreContext(string connectionString)
        {
            this.connectionString = connectionString;
        }

        private MySqlConnection GetConnection()
        {
            return (new MySqlDatabase(this.connectionString)).Connection;
        }

        public List<Entry> GetAllEntries()
        {
            List<Entry> list = new List<Entry>();

            using (MySqlConnection conn = GetConnection())
            {
                MySqlCommand cmd = new MySqlCommand("SELECT * FROM noticias WHERE Activo = true ORDER BY FechaPublicacion DESC LIMIT 25", conn);

                using (var reader = cmd.ExecuteReader())
                {
                    while (reader.Read())
                    {
                        list.Add(new Entry()
                        {
                            Id = Convert.ToInt32(reader["Id"]),
                            Titulo = reader["Titulo"].ToString(),
                            Extracto = reader["Extracto"].ToString(),
                            Contenido = reader["Contenido"].ToString(),
                            Cubeta = reader["Cubeta"].ToString(),
                            NoticiaImportante = Convert.ToBoolean(reader["NoticiaImportante"]),
                            Tipo = reader["Tipo"].ToString(),
                            FechaCreacion = Convert.ToDateTime(reader["FechaCreacion"]),
                            FechaPublicacion = Convert.ToDateTime(reader["FechaPublicacion"]),
                            FechaActualizacion = Convert.ToDateTime(reader["FechaActualizacion"]),
                            Activo = Convert.ToBoolean(reader["Activo"])
                        });
                    }
                }
            }

            return list;
        }

        public void CubetizaAll()
        {
            var textToCubetize = new List<KeyValuePair<string, string>>();

            using (var conn = GetConnection())
            {
                var cmd = new MySqlCommand("SELECT * FROM noticias ORDER BY FechaPublicacion DESC", conn);

                using (var reader = cmd.ExecuteReader())
                {
                    while (reader.Read())
                    {
                        var id = Convert.ToInt32(reader["Id"]).ToString();
                        var titulo = reader["Titulo"].ToString();
                        var extracto = reader["Extracto"].ToString();
                        var contenido = reader["Contenido"].ToString();

                        var cubeta = TextTools.MagicWords(string.Join(' ', titulo, extracto, contenido));

                        var idTextPair = new KeyValuePair<string, string>(id, cubeta);

                        textToCubetize.Add(idTextPair);
                    }
                }
            }

            foreach(var idTextPair in textToCubetize)
            {
                using (var conn = GetConnection())
                {
                    var cmdUpdate = conn.CreateCommand() as MySqlCommand;

                    cmdUpdate.CommandText = "UPDATE noticias SET Cubeta=@Cubeta WHERE ID=@Id";
                    cmdUpdate.Parameters.AddWithValue("@Cubeta", idTextPair.Value);
                    cmdUpdate.Parameters.AddWithValue("@Id", idTextPair.Key);

                    var recs = cmdUpdate.ExecuteNonQuery();
                }
            }
            
        }

        /// <summary>
        /// Guarda un registro a base de datos.
        /// 
        /// EN ESTE METODO SE MANDA A LLAMAR UNA PIEZA CLAVE PARA EL ANALISIS Y GENERACI??n DE TRENDINGS (...)
        /// </summary>
        /// <param name="entry">Objeto que carga la informaci??n de entrada</param>
        /// <returns>true si se insert?? correctamente | false si ocurri?? lo contrario.</returns>
        public bool SetEntry(Entry entry)
        {
            using(MySqlConnection conn = GetConnection())
            {
                var cmd = conn.CreateCommand() as MySqlCommand;

                cmd.CommandText = "INSERT INTO noticias(Titulo, Extracto, Contenido, Cubeta, NoticiaImportante, Tipo, FechaCreacion, FechaPublicacion, FechaActualizacion) VALUES(@Titulo, @Extracto, @Contenido, @Cubeta, @NoticiaImportante, @Tipo, @FechaCreacion, @FechaPublicacion, @FechaActualizacion)";

                var cubeta = TextTools.MagicWords(string.Join(" ", entry.Titulo, entry.Extracto, entry.Contenido));

                var dateTimeNow = DateTime.Now;
                cmd.Parameters.AddWithValue("@Titulo", entry.Titulo);
                cmd.Parameters.AddWithValue("@Extracto", entry.Extracto);
                cmd.Parameters.AddWithValue("@Contenido", entry.Contenido);
                cmd.Parameters.AddWithValue("@Cubeta", cubeta);
                cmd.Parameters.AddWithValue("@NoticiaImportante", entry.NoticiaImportante);
                cmd.Parameters.AddWithValue("@Tipo", entry.Tipo);
                cmd.Parameters.AddWithValue("@FechaCreacion", dateTimeNow);
                cmd.Parameters.AddWithValue("@FechaPublicacion", entry.FechaPublicacion);
                cmd.Parameters.AddWithValue("@FechaActualizacion", dateTimeNow);

                var recs = cmd.ExecuteNonQuery();
            }

            return true;
        }

        public List<Trending> GetTrendings()
        {
            List<Trending> list = new List<Trending>();

            using (MySqlConnection conn = GetConnection())
            {
                MySqlCommand cmd = new MySqlCommand("SELECT * FROM trendings", conn);

                using (var reader = cmd.ExecuteReader())
                {
                    while (reader.Read())
                    {
                        list.Add(new Trending()
                        {
                            Id = Convert.ToInt32(reader["id"]),
                            IdBusqueda = Convert.ToInt32(reader["id_busqueda"]),
                            IdNoticia = Convert.ToInt32(reader["id_noticias"]),
                            Titulo = reader["titulo"].ToString(),
                            Extracto = reader["extracto"].ToString(),
                            Programa = reader["programa"].ToString(),
                            Seccion = reader["seccion"].ToString(),
                            Tipo = reader["tipo"].ToString(),
                            Link = reader["link"].ToString(),
                            FechaTrending = reader["fecha_trending"].ToString()
                        });
                    }
                }
            }

            return list;
        }

        public bool SetTrendings()
        {
            var datetime = DateTime.Now;

            var today = datetime.ToString("yyyy-MM-dd");
            var yesterday = datetime.AddDays((double)-1).ToString("yyyy-MM-dd");
            var strToday = string.Format("{0} {1}", today, "00:00:00");
            var strYesterday = string.Format("{0} {1}", yesterday, "00:00:00");

            List<KeyValuePair<string, string>> tendencias = new List<KeyValuePair<string, string>>();

            using (var conn = GetConnection())
            {
                var cmd = new MySqlCommand(string.Format("SELECT * FROM tendencias WHERE fecha_busqueda > '{0}' GROUP BY id_busqueda ORDER BY fecha_busqueda DESC",
                                                            strYesterday), conn);

                using (var reader = cmd.ExecuteReader())
                {
                    while (reader.Read())
                    {
                        var tendencia = new KeyValuePair<string, string> (reader["id_busqueda"].ToString(), reader["fecha_busqueda"].ToString());
                        tendencias.Add(tendencia);
                    }
                }
            }

            // Contabilizar tendencias
            Dictionary<int, int> tendemeter = new Dictionary<int, int>();
            foreach(var tendencia in tendencias){
                if (tendemeter.ContainsKey(Int32.Parse(tendencia.Key)))
                {
                    int counter = 0;
                    tendemeter.TryGetValue(Int32.Parse(tendencia.Key), out counter);
                    counter++;
                    tendemeter[Int32.Parse(tendencia.Key)] = counter;
                }
                else{
                    tendemeter.Add(Int32.Parse(tendencia.Key), 1);
                }
            }

            // Ordenar por la mayor tendencia
            var sortedTendemer = tendemeter.ToList();
            var trendNews = new List<View>();
            foreach (var tender in sortedTendemer.OrderByDescending( tender => tender.Value))
            {
                using (var conn = GetConnection())
                {
                    var cmd = new MySqlCommand(string.Format("SELECT * FROM visitas WHERE id_busqueda = {0} AND fecha_visita > '{1}' ORDER BY fecha_visita DESC",
                                                                tender.Key, strYesterday), conn);

                    using (var reader = cmd.ExecuteReader())
                    {
                        while (reader.Read())
                        {
                            var trend = new View();
                            trend.IdNoticia = Convert.ToInt32(reader["id_noticia"]);
                            trend.IdBusqueda = Convert.ToInt32(reader["id_busqueda"]);
                            trend.Link = reader["link"].ToString();
                            trend.FechaVisita = reader["fecha_visita"].ToString();

                            trendNews.Add(trend);
                        }
                    }
                }
            }

            // Tendencias de hoy
            Dictionary<string, KeyValuePair<int, int>> todayTrends = new Dictionary<string, KeyValuePair<int, int>>();
            foreach (var view in trendNews)
            {
                var tday = DateTime.ParseExact(strToday, "yyyy-MM-dd HH:mm:ss", CultureInfo.InvariantCulture);
                var trendDate = DateTime.ParseExact(view.FechaVisita, "dd/MM/yyyy HH:mm:ss", CultureInfo.InvariantCulture);
                if (trendDate > tday)
                {
                    if (todayTrends.ContainsKey(view.Link))
                    {
                        KeyValuePair<int, int> valuePair = new KeyValuePair<int, int>();
                        todayTrends.TryGetValue(view.Link, out valuePair);
                        var counter = valuePair.Value;
                        counter++;
                        todayTrends[view.Link] = new KeyValuePair<int, int> (valuePair.Key, counter);
                    }
                    else{
                        todayTrends.Add(view.Link, new KeyValuePair<int, int>( view.IdNoticia, 1));
                    }
                }
            }

            // Tendencias de ayer
            Dictionary<string, KeyValuePair<int, int>> yesterTrends = new Dictionary<string, KeyValuePair<int, int>>();
            foreach (var view in trendNews)
            {
                var tday = DateTime.ParseExact(strToday, "yyyy-MM-dd HH:mm:ss", CultureInfo.InvariantCulture);
                var trendDate = DateTime.ParseExact(view.FechaVisita, "dd/MM/yyyy HH:mm:ss", CultureInfo.InvariantCulture);
                if (trendDate < tday)
                {
                    if (yesterTrends.ContainsKey(view.Link))
                    {
                        KeyValuePair<int, int> valuePair = new KeyValuePair<int, int>();
                        yesterTrends.TryGetValue(view.Link, out valuePair);
                        var counter = valuePair.Value;
                        counter++;
                        yesterTrends[view.Link] = new KeyValuePair<int, int> (valuePair.Key, counter);
                    }
                    else{
                        yesterTrends.Add(view.Link, new KeyValuePair<int, int>( view.IdNoticia, 1));
                    }
                }
            }

            // Busca los trendings de hoy
            int maxTrends = 5;
            int i = 0;

            var sortToday = todayTrends.ToList();
            var selectedTodayTrends = new List<Trending>();
            foreach (var tender in sortToday.OrderByDescending( tender => tender.Value.Value))
            {
                if (!(i < maxTrends))
                {
                    break;
                }

                using (var conn = GetConnection())
                {
                    var cmd = new MySqlCommand(string.Format("SELECT * FROM noticias WHERE Id = {0}",
                                                                tender.Value.Key), conn);

                    using (var reader = cmd.ExecuteReader())
                    {
                        while (reader.Read())
                        {
                            var theTrend = new Trending();

                            theTrend.IdNoticia = Convert.ToInt32(reader["Id"]);
                            theTrend.Titulo = reader["Titulo"].ToString();
                            theTrend.Extracto = reader["Extracto"].ToString();
                            theTrend.Programa = reader["Programa"].ToString();
                            theTrend.Seccion = reader["Seccion"].ToString();
                            theTrend.Categoria = reader["Categoria"].ToString();
                            theTrend.Tipo = reader["Tipo"].ToString();
                            theTrend.Link = tender.Key;
                            theTrend.FechaTrending = strToday;

                            selectedTodayTrends.Add(theTrend);                    }
                    }
                }

            }
            
            // Busca los trendings de ayer
            i = 0;

            var sortYester = yesterTrends.ToList();
            var selectedYesterTrends = new List<Trending>();
            foreach (var tender in sortYester.OrderByDescending( tender => tender.Value.Value))
            {
                if (!(i < maxTrends))
                {
                    break;
                }

                using (var conn = GetConnection())
                {
                    var cmd = new MySqlCommand(string.Format("SELECT * FROM noticias WHERE Id = {0}",
                                                                tender.Value.Key), conn);

                    using (var reader = cmd.ExecuteReader())
                    {
                        while (reader.Read())
                        {
                            var theTrend = new Trending();

                            theTrend.IdNoticia = Convert.ToInt32(reader["Id"]);
                            theTrend.Titulo = reader["Titulo"].ToString();
                            theTrend.Extracto = reader["Extracto"].ToString();
                            theTrend.Programa = reader["Programa"].ToString();
                            theTrend.Seccion = reader["Seccion"].ToString();
                            theTrend.Categoria = reader["Categoria"].ToString();
                            theTrend.Tipo = reader["Tipo"].ToString();
                            theTrend.Link = tender.Key;
                            theTrend.FechaTrending = strYesterday;

                            selectedYesterTrends.Add(theTrend);                    }
                    }
                }

            }

            // Vacia la table de trendings
            using(MySqlConnection conn = GetConnection())
            {
                var cmd = conn.CreateCommand() as MySqlCommand;
                cmd.CommandText = "TRUNCATE TABLE trendings";
                var recs = cmd.ExecuteNonQuery();
            }
            
            // Insertar trendins de hoy
            foreach (var trend in selectedTodayTrends)
            {
                using(MySqlConnection conn = GetConnection())
                {
                    var cmd = conn.CreateCommand() as MySqlCommand;

                    cmd.CommandText = "INSERT INTO trendings(id_noticias, id_busqueda, titulo, extracto, programa, seccion, categoria, tipo, link, fecha_trending) values(@id_noticias, @id_busqueda, @titulo, @extracto, @programa, @seccion, @categoria, @tipo, @link, @fecha_trending)";

                    cmd.Parameters.AddWithValue("@id_noticias", trend.IdNoticia);
                    cmd.Parameters.AddWithValue("@id_busqueda", trend.IdBusqueda);
                    cmd.Parameters.AddWithValue("@titulo", trend.Titulo);
                    cmd.Parameters.AddWithValue("@extracto", trend.Extracto);
                    cmd.Parameters.AddWithValue("@programa", trend.Programa);
                    cmd.Parameters.AddWithValue("@seccion", trend.Seccion);
                    cmd.Parameters.AddWithValue("@categoria", trend.Categoria);
                    cmd.Parameters.AddWithValue("@tipo", trend.Tipo);
                    cmd.Parameters.AddWithValue("@link", trend.Link);
                    cmd.Parameters.AddWithValue("@fecha_trending", trend.FechaTrending);

                    var recs = cmd.ExecuteNonQuery();
                }
            }

            // Insertar trendins de ayer
            foreach (var trend in selectedYesterTrends)
            {
                using(MySqlConnection conn = GetConnection())
                {
                    var cmd = conn.CreateCommand() as MySqlCommand;

                    cmd.CommandText = "INSERT INTO trendings(id_noticias, id_busqueda, titulo, extracto, programa, seccion, categoria, tipo, link, fecha_trending) values(@id_noticias, @id_busqueda, @titulo, @extracto, @programa, @seccion, @categoria, @tipo, @link, @fecha_trending)";

                    cmd.Parameters.AddWithValue("@id_noticias", trend.IdNoticia);
                    cmd.Parameters.AddWithValue("@id_busqueda", trend.IdBusqueda);
                    cmd.Parameters.AddWithValue("@titulo", trend.Titulo);
                    cmd.Parameters.AddWithValue("@extracto", trend.Extracto);
                    cmd.Parameters.AddWithValue("@programa", trend.Programa);
                    cmd.Parameters.AddWithValue("@seccion", trend.Seccion);
                    cmd.Parameters.AddWithValue("@categoria", trend.Categoria);
                    cmd.Parameters.AddWithValue("@tipo", trend.Tipo);
                    cmd.Parameters.AddWithValue("@link", trend.Link);
                    cmd.Parameters.AddWithValue("@fecha_trending", trend.FechaTrending);

                    var recs = cmd.ExecuteNonQuery();
                }
            }

            return true;
        }

        public List<Entry> GetBehavior(string token)
        {
            List<Entry> list = new List<Entry>();
            string keywords = "";

            using (var conn = GetConnection())
            {
                var cmd = new MySqlCommand("SELECT * FROM behavior_bucket WHERE token=@token", conn);
                cmd.Parameters.AddWithValue("@token", token);
                using (var reader = cmd.ExecuteReader())
                {
                    while (reader.Read())
                    {
                        keywords = reader["keywords"].ToString();
                    }
                }
            }

            using (MySqlConnection conn = GetConnection())
            {
                var querySearch = string.Format(@"SELECT * FROM noticias
                                                    WHERE MATCH (Cubeta) AGAINST ('{0}')
                                                    AND Activo = true order by FechaPublicacion DESC", keywords);

                var cmd = new MySqlCommand(querySearch, conn);

                using (var reader = cmd.ExecuteReader())
                {
                    while (reader.Read())
                    {
                        list.Add(new Entry()
                        {
                            Id = Convert.ToInt32(reader["Id"]),
                            IdBusqueda = 0,
                            Titulo = reader["Titulo"].ToString(),
                            Extracto = reader["Extracto"].ToString(),
                            Contenido = reader["Contenido"].ToString(),
                            NoticiaImportante = Convert.ToBoolean(reader["NoticiaImportante"]),
                            Tipo = reader["Tipo"].ToString(),
                            Link = TextTools.ToLinkString(reader["FechaPublicacion"].ToString()) + "/" + TextTools.ToLinkString(reader["Titulo"].ToString()),
                            FechaCreacion = Convert.ToDateTime(reader["FechaCreacion"]),
                            FechaPublicacion = Convert.ToDateTime(reader["FechaPublicacion"]),
                            FechaActualizacion = Convert.ToDateTime(reader["FechaActualizacion"]),
                            Activo = Convert.ToBoolean(reader["Activo"])
                        });
                    }
                }
            }

            return list;
        }

        public bool SetBehavior(View view)
        {
            using(MySqlConnection conn = GetConnection())
            {
                var cmd = conn.CreateCommand() as MySqlCommand;

                cmd.CommandText = "INSERT INTO behavior(id_noticia, token, fecha_visita) VALUES(@id_noticia, @token, @fecha_visita)";

                var dateTimeNow = DateTime.Now;
                cmd.Parameters.AddWithValue("@id_noticia", view.IdNoticia);
                cmd.Parameters.AddWithValue("@token", view.Token);
                cmd.Parameters.AddWithValue("@fecha_visita", dateTimeNow);

                var recs = cmd.ExecuteNonQuery();
            }

            // Obtener keywords para obtener notas similares
            // Este paso puede ser omitido si se tienes keywords desde front
            string keywords = "";
            string classification = "";
            using (var conn = GetConnection())
            {
                var cmd = new MySqlCommand(string.Format("SELECT * FROM noticias WHERE Id = {0}",
                                                            view.IdNoticia), conn);

                using (var reader = cmd.ExecuteReader())
                {
                    while (reader.Read())
                    {
                        var titulo = reader["Titulo"].ToString();
                        var extracto = reader["Extracto"].ToString();
                        keywords = TextTools.MostWords(string.Join(" ", titulo, extracto));
                        classification = string.Join(",", (new string[] {reader["Programa"].ToString(), reader["Seccion"].ToString(), reader["Categoria"].ToString() }).Where(s => !string.IsNullOrEmpty(s)));
                    }
                }
            }

            var insert = true;
            using (var conn = GetConnection())
            {
                var cmd = new MySqlCommand(string.Format("SELECT * FROM behavior_bucket WHERE token = '{0}'",
                                                            view.Token), conn);

                using (var reader = cmd.ExecuteReader())
                {
                    while (reader.Read())
                    {
                        insert = false;
                        var bucket = reader["keywords"].ToString();
                        var bucketClass = reader["classification"].ToString();
                        keywords = string.Join(" ", TextTools.MostWords(keywords), bucket);
                        classification = string.Join(",", classification.Trim(), bucketClass.Trim());

                        // Keywords
                        Dictionary<string,string> k = new Dictionary<string, string>();
                        foreach(var anyword in keywords.Split(" "))
                        {
                            if(!string.IsNullOrEmpty(anyword))
                            {
                                if (!k.ContainsKey(anyword))
                                {
                                    k.Add(anyword, "");
                                }
                            }
                        }
                        
                        var kk = k.ToList();
                        keywords = "";
                        int c = 0;
                        foreach(var kw in kk)
                        {
                            if (c == 9)
                            {
                                break;
                            }
                            keywords += kw.Key + " ";
                            c++;
                        }

                        keywords = keywords.TrimEnd(' ');

                        // Classification
                        Dictionary<string,string> clss = new Dictionary<string, string>();
                        foreach(var anyclass in classification.Split(","))
                        {
                            if(!string.IsNullOrEmpty(anyclass))
                            {
                                if (!clss.ContainsKey(anyclass))
                                {
                                    clss.Add(anyclass, "");
                                }
                            }
                        }
                        
                        var cc = clss.ToList();
                        classification = "";
                        c = 0;
                        foreach(var cl in cc)
                        {
                            if (c == 6)
                            {
                                break;
                            }
                            classification += cl.Key + ",";
                            c++;
                        }

                        classification = classification.TrimEnd(',');
                    }
                }
            }

            if (insert)
            {
                using(MySqlConnection conn = GetConnection())
                {
                    var cmd = conn.CreateCommand() as MySqlCommand;

                    cmd.CommandText = "INSERT INTO behavior_bucket(token, keywords, classification) values(@token, @keywords, @classification)";

                    cmd.Parameters.AddWithValue("@token", view.Token);
                    cmd.Parameters.AddWithValue("@keywords", keywords);
                    cmd.Parameters.AddWithValue("@classification", classification);
                    cmd.ExecuteNonQuery();
                }
            }
            else
            {
                using (var conn = GetConnection())
                {
                    var cmdUpdate = conn.CreateCommand() as MySqlCommand;

                    cmdUpdate.CommandText = "UPDATE behavior_bucket SET keywords =@keywords,classification =@classification WHERE token =@token";
                    cmdUpdate.Parameters.AddWithValue("@token", view.Token);
                    cmdUpdate.Parameters.AddWithValue("@keywords", keywords);
                    cmdUpdate.Parameters.AddWithValue("@classification", classification);
                    cmdUpdate.ExecuteNonQuery();
                }
            }

            return true;
        }

        public bool SetView(View view)
        {
            using(MySqlConnection conn = GetConnection())
            {
                var cmd = conn.CreateCommand() as MySqlCommand;

                cmd.CommandText = "INSERT INTO visitas(id_noticia, id_busqueda, link, fecha_visita) VALUES(@id_noticia, @id_busqueda, @link, @fecha_visita)";

                var dateTimeNow = DateTime.Now;
                cmd.Parameters.AddWithValue("@id_noticia", view.IdNoticia);
                cmd.Parameters.AddWithValue("@id_busqueda", view.IdBusqueda);
                cmd.Parameters.AddWithValue("@link", view.Link);
                cmd.Parameters.AddWithValue("@fecha_visita", dateTimeNow);

                var recs = cmd.ExecuteNonQuery();
            }

            return true;
        }

    }
}