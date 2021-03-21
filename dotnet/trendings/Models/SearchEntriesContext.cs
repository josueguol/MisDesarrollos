using System;
using System.Collections.Generic;
using MySql.Data.MySqlClient;
using Trendings.Context;
    
namespace Trendings.Models
{    
    public class SearchEntriesContext
    {
        private string connectionString;

        public SearchEntriesContext(string connectionString)
        {
            this.connectionString = connectionString;
        }

        private MySqlConnection GetConnection()
        {
            return (new MySqlDatabase(this.connectionString)).Connection;
        }

        public List<Entry> Search(SearchPayload payload)
        {
            List<Entry> list = new List<Entry>();
            var searchText = TextTools.MagicWords(payload.Phrase);
            var dateTimeNow = DateTime.Now;
            var hasRows = false;
            int idBusqueda = 0;
            int idInsert = -1;

            if (string.IsNullOrEmpty(searchText))
            {
                return list;
            }

            using (MySqlConnection conn = GetConnection())
            {

                MySqlCommand cmd = new MySqlCommand(string.Format("SELECT * FROM historico_busquedas WHERE palabras = '{0}'", searchText), conn);
                using (var reader = cmd.ExecuteReader())
                {
                    if (reader.HasRows)
                    {
                        hasRows = true;
                        while (reader.Read())
                        {
                            idBusqueda = Convert.ToInt32(reader["id"]);
                        }
                    }
                }

            }

            using (MySqlConnection conn = GetConnection())
            {
                if (hasRows)
                {
                    var cmdInsert = conn.CreateCommand() as MySqlCommand;

                    cmdInsert.CommandText = "INSERT INTO tendencias(id_busqueda, fecha_busqueda) values(@id_busqueda, @fecha_busqueda)";
                    dateTimeNow = dateTimeNow.AddSeconds((double)dateTimeNow.Second * -1);
                    cmdInsert.Parameters.AddWithValue("@id_busqueda", idBusqueda);
                    cmdInsert.Parameters.AddWithValue("@fecha_busqueda", dateTimeNow);

                    var recs = cmdInsert.ExecuteNonQuery();
                }
                else
                {
                    var cmdInsert = conn.CreateCommand() as MySqlCommand;

                    cmdInsert.CommandText = "INSERT INTO historico_busquedas(palabras, fecha_alta) values(@palabras, @fecha_alta);select last_insert_id();";
                    cmdInsert.Parameters.AddWithValue("@palabras", searchText);
                    cmdInsert.Parameters.AddWithValue("@fecha_alta", dateTimeNow);

                    idInsert = Convert.ToInt32(cmdInsert.ExecuteScalar());
                }
            }

            if(idInsert > 0)
            {
                using (MySqlConnection conn = GetConnection())
                {
                    var cmdInsert = conn.CreateCommand() as MySqlCommand;

                    cmdInsert.CommandText = "INSERT INTO tendencias(id_busqueda, fecha_busqueda) values(@id_busqueda, @fecha_busqueda)";
                    dateTimeNow = dateTimeNow.AddSeconds((double)dateTimeNow.Second * -1);
                    cmdInsert.Parameters.AddWithValue("@id_busqueda", idInsert);
                    cmdInsert.Parameters.AddWithValue("@fecha_busqueda", dateTimeNow);

                    var recs = cmdInsert.ExecuteNonQuery();
                }
            }

            using (MySqlConnection conn = GetConnection())
            {
                var querySearch = string.Format(@"SELECT * FROM noticias
                                                    WHERE MATCH (Cubeta) AGAINST ('{0}')
                                                    AND Activo = true order by FechaPublicacion DESC", searchText);

                var cmd = new MySqlCommand(querySearch, conn);

                using (var reader = cmd.ExecuteReader())
                {
                    while (reader.Read())
                    {
                        list.Add(new Entry()
                        {
                            Id = Convert.ToInt32(reader["Id"]),
                            IdBusqueda = idInsert > 0 ? idInsert : idBusqueda,
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
    
    }
}