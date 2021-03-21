using Amazon.S3;
using Amazon.S3.Model;
using Amazon.S3.Transfer;
using System;
using System.Collections.Generic;
using System.IO;
using System.Threading.Tasks;

namespace FileSearchS3
{
    public class AWSSearch
    {
        private static IAmazonS3 _s3Client;
        private string _accessKey = "AKIASCK3HVPBL75LJFHA";
        private string _secretKey = "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";
        private string _bucketName = "colmena2019";

        public AWSSearch()
        {
            setAWSS3Client();
        }
        public AWSSearch(string accessKey, string secretKey, string bucketName)
        {
            _accessKey = accessKey;
            _secretKey = secretKey;
            _bucketName = bucketName;
            setAWSS3Client();
        }

        public async Task<List<S3Object>> GetObjectsDir(string prefixDir)
        {
            try
            {
                ListObjectsV2Request request = new ListObjectsV2Request
                {
                    BucketName = _bucketName,
                    Prefix = prefixDir
                };
                
                ListObjectsV2Response response;
                List<S3Object> s3Objects = new List<S3Object>();

                do
                {
                    response = await _s3Client.ListObjectsV2Async(request);

                    s3Objects.AddRange(response.S3Objects);

                    request.ContinuationToken = response.NextContinuationToken;
                } while (response.IsTruncated);

                return s3Objects;
            }
            catch (AmazonS3Exception amazonS3Exception)
            {
                Console.WriteLine("S3 error occurred. Exception: " + amazonS3Exception.ToString());
                return null;
            }
            catch (Exception e)
            {
                Console.WriteLine("Exception: " + e.ToString());
                return null;
            }
        }

        public async Task<string> ReadObjectXml(string keyObjectFile)
        {
            try
            {
                string responseObjectXml = string.Empty;

                GetObjectRequest request = new GetObjectRequest()
                {
                    BucketName = _bucketName,
                    Key = keyObjectFile
                };

                using (GetObjectResponse response = await _s3Client.GetObjectAsync(request))
                using (Stream responseStream = response.ResponseStream)
                using (StreamReader reader = new StreamReader(responseStream))
                {
                    string header = response.Headers["Content-Type"];
                    Console.WriteLine("Content: {0}", header);

                    responseObjectXml = reader.ReadToEnd();
                }

                return responseObjectXml;
            }
            catch (AmazonS3Exception amazonS3Exception)
            {
                Console.WriteLine("S3 error occurred. Exception: " + amazonS3Exception.ToString());
                return null;
            }
            catch (Exception e)
            {
                Console.WriteLine("Exception: " + e.ToString());
                return null;
            }
        }

        public async Task<bool> SaveObjectXml(string keyObjectFile, MemoryStream xmlData)
        {
            try
            {
                var fileTransferUtility = new TransferUtility(_s3Client);

                await fileTransferUtility.UploadAsync(xmlData, _bucketName, keyObjectFile);
                
                Console.WriteLine("Upload completed");

                return true;
            }
            catch (AmazonS3Exception amazonS3Exception)
            {
                Console.WriteLine("S3 error occurred. Exception: " + amazonS3Exception.ToString());
                return false;
            }
            catch (Exception e)
            {
                Console.WriteLine("Exception: " + e.ToString());
                return false;
            }
        }

        private void setAWSS3Client()
        {
            _s3Client = new AmazonS3Client(
                _accessKey,
                _secretKey,
                Amazon.RegionEndpoint.USEast1
            );
        }
    }
}
