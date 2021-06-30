/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author jason
 */
public class MyDate {
    //set private variables
    private int month;
    private int day;
    private int year;
    //getters
    public int getMonth(){return month;}
    public int getDay(){return day;}
    public int getYear(){return year;}
    //setters
    public void setMonth(int newMonth){month = newMonth;}
    public void setDay(int newDay){day = newDay;}
    public void setYear(int newYear){year = newYear;}
    
    //default constructor
    public MyDate(){
        month = 10;
        day = 6;
        year = 2020;
        
    }
    
    //constructor
    public MyDate(int newMonth, int newDay, int newYear){
        month = newMonth;
        day = newDay;
        year = newYear;
        
    }
    
    
}
