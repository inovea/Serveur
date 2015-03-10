/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package inovea_jpa;

import entities.SteedEntity;
import interfaces.SteedService;
import physique.FactoryPhysique;

/**
 *
 * @author Oussama
 */
public class Inovea_JPA {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) throws Exception {
        SteedService steedSrv = FactoryPhysique.getSteedSrv();
        
        
        SteedEntity steed = new SteedEntity("oussama.bentalha", "lol", "Bentalha", "Oussama");
        steed = steedSrv.add(steed);
        
    }
    
}
