using System;

namespace Trendings.Models
{
    public class Trending
    {
        public int Id { get; set; }

        public int IdNoticia { get; set; }

        public int IdBusqueda { get; set; }

        public string Titulo { get; set; }

        public string Extracto { get; set; }

        public string Programa { get; set; }

        public string Seccion { get; set; }

        public string Categoria { get; set; }

        public string Tipo { get; set; }

        public string Link { get; set; }

        public string FechaTrending { get; set; }
    }
}