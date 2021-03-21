namespace s3editor
{
    public class Ejemplo
    {
        private string _nombre;
        public string Nombre
        {
            get
            {
                return _nombre;
            }
        }

        public string Summary { get; set; }

        public void SetNombre(string nombre)
        {
            _nombre = nombre;
        }
    }
}
