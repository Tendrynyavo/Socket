package serveur;

import client.Client;

import java.io.IOException;
import java.net.ServerSocket;
import java.net.Socket;

public class Serveur2 {
    ServerSocket serverSocket;
    Socket socket;

    public Socket getSocket() {
        return socket;
    }

    public ServerSocket getServerSocket() {
        return serverSocket;
    }

    public void setServerSocket(ServerSocket serverSocket) {
        this.serverSocket = serverSocket;
    }

    public void setSocket(Socket socket) {
        this.socket = socket;
    }

    public static void main(String[] args) throws IOException {
        ServerSocket server = null;
        try {
            server = new ServerSocket(1013);
            Client client = new Client(server.accept());
            while (true) {
                String protocol = client.getInput().readUTF();
                if (protocol.equals("send")) {
                    Serveur.sendFile(client, "D:\\transfert\\other2\\");
                } else if (protocol.equals("receive")) {
                    Serveur.receiveFile(client, "D:\\transfert\\other2\\");
                }
            }
        }catch (Exception e) {
            server.close();
            e.printStackTrace();
        }
    }
}
