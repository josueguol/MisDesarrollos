using System;

namespace Trendings.Models
{
    public class Entry
    {
        public int Id { get; set; }
        
        public int IdBusqueda { get; set; }

        public string Titulo { get; set; }

        public string Extracto { get; set; }

        public string Contenido { get; set; }

        public string Cubeta { get; set; }

        public bool NoticiaImportante { get; set; }

        public string Tipo { get; set; }

        public DateTime FechaCreacion { get; set; }

        public DateTime FechaPublicacion { get; set; }

        public DateTime FechaActualizacion { get; set; }

        public string Link { get; set; }

        public bool Activo { get; set; }
    }
}