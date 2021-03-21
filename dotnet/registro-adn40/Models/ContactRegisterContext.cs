using System;
using System.IO;
using Microsoft.Extensions.Configuration;
using RegisterADN40.Models.Entities;
using System.Threading.Tasks;
using Newtonsoft.Json;

using Amazon.S3;
using Amazon.S3.Transfer;
using Amazon.S3.Model;
using System.Collections.Generic;
using OfficeOpenXml;

namespace RegisterADN40.Models
{
    public class ContactRegisterContext
    {
        private IConfiguration configuration;

        public ContactRegisterContext(IConfiguration configuration)
        {
            this.configuration = configuration;
        }

        public bool SetContact(Contact contact)
        {
            bool result = true;

            var theContact = JsonConvert.SerializeObject(contact);
            var inputContact = new MemoryStream(System.Text.Encoding.UTF8.GetBytes(theContact));

            SaveContact(inputContact).ContinueWith(task =>
            {
                result = task.Result;
            }).Wait();

            return result;
        }

        public async Task<bool> SaveContact(MemoryStream inputContact)
        {
            var s3Client = setAWSS3Client();

            try
            {
                var fileTransferUtility = new TransferUtility(s3Client);


                var date = DateTime.Now;
                Random random = new Random();
                var key = "registros_adn40/registros/" + date.ToString("yyyyMMddHHmmss-") + random.Next(100, 999).ToString() + ".json";
                var contentType = "application/json";

                var fileTransferUtilityRequest = new TransferUtilityUploadRequest
                {
                    ContentType = contentType,
                    InputStream = inputContact,
                    BucketName = (string)configuration["AWSConfig:bucketName"],
                    StorageClass = S3StorageClass.Standard,
                    Key = key,
                    CannedACL = S3CannedACL.Private
                };

                await fileTransferUtility.UploadAsync(fileTransferUtilityRequest);

                return true;
            }
            catch (AmazonS3Exception)
            {
                return false;
            }
            catch (Exception)
            {
                return false;
            }
        }

        public async Task<string> SaveXLS(MemoryStream inputContact)
        {
            var s3Client = setAWSS3Client();

            try
            {
                var fileTransferUtility = new TransferUtility(s3Client);

                var date = DateTime.Now;
                Random random = new Random();
                var name = date.ToString("yyyyMMddHHmmss-") + random.Next(100, 999).ToString() + ".xlsx";
                var key = "registros_adn40/reportes/" + name;
                var contentType = "application/octet-stream";

                var fileTransferUtilityRequest = new TransferUtilityUploadRequest
                {
                    ContentType = contentType,
                    InputStream = inputContact,
                    BucketName = (string)configuration["AWSConfig:bucketName"],
                    StorageClass = S3StorageClass.Standard,
                    Key = key,
                    CannedACL = S3CannedACL.Private
                };

                await fileTransferUtility.UploadAsync(fileTransferUtilityRequest);

                return name;
            }
            catch (AmazonS3Exception)
            {
                return "";
            }
            catch (Exception)
            {
                return "";
            }
        }

        public KeyValuePair<string, Stream> GetContacts()
        {
            MemoryStream xls = new MemoryStream();
            Stream msxls = null;
            var workbook = new ExcelPackage(xls);
            var sheet = workbook.Workbook.Worksheets.Add("Contactos");
            sheet.Cells["A1"].Value = "Nombres";
            sheet.Cells["B1"].Value = "Apellidos";
            sheet.Cells["C1"].Value = "Correo";

            int i = 2;

            GetObjectsDir("registros_adn40/registros/").ContinueWith(task =>
            {
                List<S3Object> s3Objects = task.Result;
                foreach (var s3object in s3Objects)
                {
                    if(s3object.Key.EndsWith(".json"))
                    {
                        Contact contact = new Contact();
                        ReadObjectXml(s3object.Key).ContinueWith(task =>
                        {
                            contact = JsonConvert.DeserializeObject<Contact>(task.Result);
                        }).Wait();

                        sheet.Cells["A" + i].Value = contact.Nombres;  // Nombres
                        sheet.Cells["B" + i].Value = contact.Apellidos;  // Apellidos
                        sheet.Cells["C" + i].Value = contact.Correo;  // Correo

                        //var deleted = DeleteKey(s3object.Key);
                    }
                    
                    i++;
                }

            }).Wait();

            workbook.Save();

            var name = "";
            SaveXLS(xls).ContinueWith(task =>
            {
                name = task.Result;
            }).Wait();

            ReadObjectStream("registros_adn40/reportes/" + name).ContinueWith(task =>
            {
                msxls = task.Result;
            }).Wait();

            var result = new KeyValuePair<string, Stream>(name, msxls);
            
            return result;
        }

        public async Task<string> ReadObjectXml(string keyObjectFile)
        {
            var s3Client = setAWSS3Client();
            try
            {
                string responseObject = string.Empty;

                GetObjectRequest request = new GetObjectRequest()
                {
                    BucketName = (string)configuration["AWSConfig:bucketName"],
                    Key = keyObjectFile
                };

                using (GetObjectResponse response = await s3Client.GetObjectAsync(request))
                using (Stream responseStream = response.ResponseStream)
                using (StreamReader reader = new StreamReader(responseStream))
                {
                    string header = response.Headers["Content-Type"];

                    responseObject = reader.ReadToEnd();
                }

                return responseObject;
            }
            catch (AmazonS3Exception)
            {
                return null;
            }
            catch (Exception)
            {
                return null;
            }
        }

        public async Task<Stream> ReadObjectStream(string keyObjectFile)
        {
            var s3Client = setAWSS3Client();
            try
            {
                GetObjectRequest request = new GetObjectRequest()
                {
                    BucketName = (string)configuration["AWSConfig:bucketName"],
                    Key = keyObjectFile
                };

                GetObjectResponse response = await s3Client.GetObjectAsync(request);
                
                return response.ResponseStream;
            }
            catch (AmazonS3Exception)
            {
                return null;
            }
            catch (Exception e)
            {
                return null;
            }
        }

        public byte[] ReadToEnd(Stream stream)
        {
            long originalPosition = 0;

            if(stream.CanSeek)
            {
                originalPosition = stream.Position;
                stream.Position = 0;
            }

            try
            {
                byte[] readBuffer = new byte[4096];

                int totalBytesRead = 0;
                int bytesRead;

                while ((bytesRead = stream.Read(readBuffer, totalBytesRead, readBuffer.Length - totalBytesRead)) > 0)
                {
                    totalBytesRead += bytesRead;

                    if (totalBytesRead == readBuffer.Length)
                    {
                        int nextByte = stream.ReadByte();
                        if (nextByte != -1)
                        {
                            byte[] temp = new byte[readBuffer.Length * 2];
                            Buffer.BlockCopy(readBuffer, 0, temp, 0, readBuffer.Length);
                            Buffer.SetByte(temp, totalBytesRead, (byte)nextByte);
                            readBuffer = temp;
                            totalBytesRead++;
                        }
                    }
                }

                byte[] buffer = readBuffer;
                if (readBuffer.Length != totalBytesRead)
                {
                    buffer = new byte[totalBytesRead];
                    Buffer.BlockCopy(readBuffer, 0, buffer, 0, totalBytesRead);
                }

                return buffer;
            }
            finally
            {
                if(stream.CanSeek)
                {
                    stream.Position = originalPosition; 
                }
            }
        }

        public async Task<List<S3Object>> GetObjectsDir(string prefixDir)
        {
            var s3Client = setAWSS3Client();
            try
            {
                ListObjectsV2Request request = new ListObjectsV2Request
                {
                    BucketName = (string)configuration["AWSConfig:bucketName"],
                    Prefix = prefixDir
                };

                ListObjectsV2Response response;
                List<S3Object> s3Objects = new List<S3Object>();

                do
                {
                    response = await s3Client.ListObjectsV2Async(request);

                    s3Objects.AddRange(response.S3Objects);

                    request.ContinuationToken = response.NextContinuationToken;
                } while (response.IsTruncated);

                return s3Objects;
            }
            catch (AmazonS3Exception)
            {
                return null;
            }
            catch (Exception)
            {
                return null;
            }
        }

        private async Task<bool> DeleteKey(string keyName)
        {
            var s3Client = setAWSS3Client();
            try
            {
                var deleteObjectRequest = new DeleteObjectRequest
                {
                    BucketName = (string)configuration["AWSConfig:bucketName"],
                    Key = keyName
                };

                await s3Client.DeleteObjectAsync(deleteObjectRequest);

                return true;
            }
            catch (AmazonS3Exception)
            {
                return false;
            }
            catch (Exception)
            {
                return false;
            }
        }

        private AmazonS3Client setAWSS3Client()
        {
            var regionEndpoint = Amazon.RegionEndpoint.GetBySystemName(configuration["AWSConfig:regionEndPoint"]);

            var s3Client = new AmazonS3Client(
                configuration["AWSConfig:accessKey"],
                configuration["AWSConfig:secretKey"],
                regionEndpoint
            );

            return s3Client;
        }
    }
}