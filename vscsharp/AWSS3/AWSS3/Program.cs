using Amazon.S3.Model;
using FileSearchS3;
using System;
using System.Collections.Generic;
using System.Linq;

namespace AWSS3
{
    class Program
    {
        static void Main(string[] args)
        {
            Console.WriteLine("Hello World!");

            var aws = new AWSSearch();

            aws.GetObjectsDir("Documentos/Deportes/Produccion").ContinueWith(task =>
            {
                List<S3Object> s3Objects = task.Result;
                foreach(var s3object in s3Objects)
                {
                    Console.WriteLine("Nombre: {0} | Fecha de modificación: {1} | Tamaño: {2}", s3object.Key, s3object.LastModified, s3object.Size);
                }
            }).Wait();


            var tree = new Folder()
            {
                Name = "Root",
                File = "",
                Path = "",
                SubFolder = new List<Folder>()
            };

            tree.TreeFold(tree);

            /*
            aws.ReadObjectXml("Notas/Deportes/Produccion/Futbol/Ligas.xml").ContinueWith(task =>
            {
                string xmlString = task.Result;
                Console.WriteLine("Nombre: {0}", xmlString);
            }).Wait();

            XmlDocument xmlDoc = new XmlDocument();
            xmlDoc.Load(@"\\tvaapps01\Colmena\Notas\Deportes\Produccion\notas\liga-mx\2016-03-23-17-00\pumas-con-la-mira-en-la--fiesta-grande-.xml");
            MemoryStream xmlStream = new MemoryStream();
            xmlDoc.Save(xmlStream);

            xmlStream.Flush();
            xmlStream.Position = 0;

            aws.SaveObjectXml("Notas/Deportes/Test/notas/liga-mx/2016-03-23-17-00/pumas-con-la-mira-en-la--fiesta-grande-.xml", xmlStream).ContinueWith(task =>
            {
                bool xmlString = task.Result;
                Console.WriteLine("Envío correcto?: {0}", xmlString);
            }).Wait();

            aws.ReadObjectXml("Notas/Deportes/Test/notas/liga-mx/2016-03-23-17-00/pumas-con-la-mira-en-la--fiesta-grande-.xml").ContinueWith(task =>
            {
                string xmlString = task.Result;
                Console.WriteLine("Nombre: {0}", xmlString);
            }).Wait();
            */

        }
    }



    public class Folder
    {
        public string Name;
        public string File;
        public string Path;
        public List<Folder> SubFolder;

        public void TreeFold(Folder tree)
        {
            var docDir = "Documentos/Deportes/Produccion/";
            var aws = new AWSSearch();

            aws.GetObjectsDir(docDir).ContinueWith(task =>
            {
                List<S3Object> s3Objects = task.Result;
                BuilTree(tree, docDir, "", s3Objects);
            }).Wait();
        }

        private void BuilTree(Folder tree, string docDir, string path, List<S3Object> s3Objects)
        {
            foreach (var s3Object in s3Objects.Select(obj => obj).Where(obj => obj.Key.Contains(docDir + path)))
            {

                var obj = s3Object.Key.Replace(docDir + path, "");

                if (!obj.Contains('/'))
                {
                    if (obj.EndsWith(".xml"))
                    {
                        tree.SubFolder.Add(new Folder() { File = obj, Path = path });
                    }
                }
                else if (obj.EndsWith('/'))
                {
                    var folderName = obj.TrimEnd('/');
                    folderName = folderName.Substring(0, folderName.IndexOf('/'));
                    var childFolder = new Folder()
                    {
                        Name = folderName,
                        Path = path,
                        SubFolder = new List<Folder>()
                    };
                    BuilTree(childFolder, docDir, folderName + "/", s3Objects);
                    tree.SubFolder.Add(childFolder);
                }
            }
        }
    }
}

