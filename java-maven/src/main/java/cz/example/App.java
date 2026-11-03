package cz.example;

import org.apache.commons.lang3.StringUtils;

public class App {
    public static void main(String[] args) {
        String name = args.length > 0 ? args[0] : "Trivy";
        System.out.println("Ahoj, " + StringUtils.capitalize(name) + "!");
    }
}
