package serveur;

import client.Client;
import java.io.*;
import java.net.*;
import java.util.Vector;

public class Serveur {
    ServerSocket serverSocket;
    Vector<Client> socketSec = new Vector<>();
    Client client;
    String option;

    public Vector<Client> getSocketSec() {
        return socketSec;
    }

    public void setSocketSec(Vector<Client> socketSec) {
        this.socketSec = socketSec;
    }

    public String getOption() {
        return option;
    }

    public void setOption(String option) {
        this.option = option;
    }

    public ServerSocket getServerSocket() {
        return serverSocket;
    }

    public void setServerSocket(ServerSocket serverSocket) {
        this.serverSocket = serverSocket;
    }

    public Client getClient() {
        return client;
    }

    public void setClient(Client client) {
        this.client = client;
    }

    public Serveur(int port) throws Exception {
        System.out.println("Wait for the client");
        ServerSocket server = new ServerSocket(port);
        setServerSocket(server);
        setClient(new Client(server.accept()));
        setSocketSec(getClientDisp(3));
    }
    public Vector<Client> getClientDisp(int length) throws IOException {
        Vector<Client> clients = new Vector<>();
        for (int i = 0; i < length; i++) {
            clients.add(new Client("localhost", 1011+(i+1)));
        }
        return clients;
    }

    public void sendFile() throws Exception {
        String name = getClient().getInput().readUTF();
        int count = getClient().getInput().readInt();

        System.out.println("taille = "+count);

        byte[] fileContentBytes = new byte[count];
        getClient().getInput().read(fileContentBytes);
        int divisor = getSocketSec().size();
        int divide = count / divisor;
        int off = 0;

        for(int increment = 1; increment <= divisor ; increment++, off += divide){
            getSocketSec().get(increment-1).getOut().writeUTF("send");
            getSocketSec().get(increment-1).getOut().writeUTF(name);
            if (increment == 3 ) divide=count-off;
            getSocketSec().get(increment-1).getOut().write(fileContentBytes, off, divide);
            getSocketSec().get(increment-1).getOut().flush();
        }
        FileOutputStream save = new FileOutputStream("sauvegarde.save", true);
        name = "\n" + name;
        save.write(name.getBytes());
        save.close();
    }

    public void sendNameFile() throws Exception {
        String name = getClient().getInput().readUTF();

        int divisor = getSocketSec().size();
        int off = 0;
        byte[] fileContentBytes = new byte[20000];
        int length = 0;
        for(int increment = 1; increment <= divisor ; increment++, off += length) {
            getSocketSec().get(increment-1).getOut().writeUTF("receive");
            getSocketSec().get(increment-1).getOut().writeUTF(name);
            getSocketSec().get(increment-1).getOut().flush();
            length = getSocketSec().get(increment-1).getInput().readInt();
            getSocketSec().get(increment-1).getInput().read(fileContentBytes, off, length);
        }
        getClient().getOut().writeInt(off);
        getClient().getOut().write(fileContentBytes);
    }

    public static void receiveFile(Client client, String folder) throws Exception {
        String name = client.getInput().readUTF();
        File file = new File(folder + "/" + name);
        FileInputStream input = new FileInputStream(file);
        byte[] content = new byte[(int) file.length()];


        input.read(content);
        client.getOut().writeInt((int) file.length());
        client.getOut().write(content);
        input.close();
    }

    public static void sendFile(Client client, String folder) throws Exception{
        String fileName = client.getInput().readUTF();
        FileOutputStream out = new FileOutputStream(folder + fileName);
        byte[] b = new byte[4096];
        int count;
        while ((count = client.getInput().read(b)) > -1) {
            out.write(b, 0, count);
        }
        out.close();
    }

    public static void main(String[] args) throws Exception {
        Serveur serveur = null;
        try {
            serveur = new Serveur(8090);
            while (true) {
                String protocol = serveur.getClient().getInput().readUTF();
                if (protocol.equals("send")) {
                    serveur.sendFile();
                } else if (protocol.equals("receive")) {
                    serveur.sendNameFile();
                }
            }
        } catch (Exception e) {
            if (serveur != null) serveur.getServerSocket().close();
            e.printStackTrace();
        }
    }
}