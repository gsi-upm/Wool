package es.upm.dit.gsi.DrEwe.Utils;

import java.io.FileInputStream;
import java.io.IOException;
import java.io.UnsupportedEncodingException;
import java.util.ArrayList;
import java.util.List;
import java.util.Properties;

import org.apache.http.NameValuePair;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;

public class Email {

		
		public void send(String text,String[] to,String subject){

			HttpClient httpclient = new DefaultHttpClient();
			List<NameValuePair> formparams = new ArrayList<NameValuePair>();
			formparams.add(new BasicNameValuePair("text", text));
			formparams.add(new BasicNameValuePair("subject", subject));
			String encodedTo="";
			for(String s : to){
				
				if(encodedTo.length()==0){
					encodedTo=encodedTo.concat(s);
				}else{
					encodedTo=encodedTo.concat(",");
					encodedTo=encodedTo.concat(s);
				}
				
			}
			System.out.println(encodedTo);
			formparams.add(new BasicNameValuePair("to", encodedTo));
			
			UrlEncodedFormEntity entity;
			try {
				Properties prop = new Properties();
				 prop.load(new FileInputStream("conf/gsn.properties"));
				 
				entity = new UrlEncodedFormEntity(formparams, "UTF-8");
				HttpPost httppost = new HttpPost(prop.getProperty("email_url"));
				httppost.setEntity(entity);
				httpclient.execute(httppost);
			} catch (UnsupportedEncodingException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			} catch (ClientProtocolException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			} catch (IOException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
			
		}
		public static void main (String []args){
			Email email = new Email();
			String[] to={"carlos.tempog@gmail.com","prueba@gmail.com"};
			email.send("test body",to,"test subject");

		}
}
