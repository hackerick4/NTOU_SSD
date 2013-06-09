#include <fstream>
#include <string>
#include <conio.h>
#include <iostream>
#include <windows.h>
#include <vector>
#include <sstream>
#include <mysql.h>
using namespace std;
MYSQL * mysql;
string courseID="";
string courseName="";
string courseTime="";
string courseTeacher="";
char* Utf2ANSI(const char *srcCode)
{
    int srcCodeLen=0;   
    srcCodeLen=MultiByteToWideChar(CP_UTF8,NULL,srcCode,strlen(srcCode),NULL,0);   
    wchar_t* result_t=new wchar_t[srcCodeLen+1];   
    MultiByteToWideChar(CP_UTF8,NULL,srcCode,strlen(srcCode),result_t,srcCodeLen); 
    result_t[srcCodeLen]='\0';   
    srcCodeLen=WideCharToMultiByte(CP_ACP,NULL,result_t,wcslen(result_t),NULL,0,NULL,NULL);   
    char* result=new char[srcCodeLen+1];   
    WideCharToMultiByte(CP_ACP,NULL,result_t,wcslen(result_t),result,srcCodeLen,NULL,NULL);  
    result[srcCodeLen]='\0';   
    delete result_t;    
    return result;  
}

void buildQueryString(string &query, string insert){
	query +="'" ;
	query += insert;
	query +="'," ;
}

void insert2DB(bool normalCase){
	string query = "INSERT INTO  `ssd`.`course_info` (`course_ID` ,`course_name` ,`course_time` ,`teacher` )VALUES (";
	buildQueryString(query,courseID);
	buildQueryString(query,courseName);
	buildQueryString(query,courseTime);
	buildQueryString(query,courseTeacher);
	query = query.substr(0,query.length()-1);
	query += ")";
	cout <<query << endl;
	if( mysql_query(mysql, query.c_str())){
        printf("Error %u: %s\n", mysql_errno(mysql), mysql_error(mysql));
		getch();
        exit(1);
    }else{
        printf("Insert success\n");   
    }
	 cout << "--------------------\n\n";
}

void takeToken(string s){
	courseID="";
	courseName="";
	courseTime="";
	 courseTeacher="";
    vector<string> v;
	vector<string>::iterator it;
	bool normalCase = true;
	v.assign(
	istream_iterator<string>(stringstream(s)),
	istream_iterator<string>()
	);
	if (v.size() ==3) normalCase =false;
	it = v.begin();
    courseID = (*it);
	++it;
	courseName = (*it);
	++it;
	if (normalCase) {
		courseTime = (*it);
		++it;
		courseTeacher= (*it);
		++it;
	}
	else{
		if (atoi((*it).c_str())) //has time but no teacher
			courseTime = (*it);
		else courseTeacher= (*it); //has teacher but no time
	} 
    cout << "get courseID : " << courseID <<endl;
	cout << "get courseName : " << courseName <<endl;
	cout << "get courseTime : " << courseTime <<endl;
	cout << "get courseTeacher : " << courseTeacher <<endl;

	insert2DB(normalCase);

}

int main (){
     std::ifstream fin;
	 fin.open("source.s");
	 std:: string readIn;
	 unsigned int line=1;
	  mysql = mysql_init(NULL);
	  if (mysql == NULL) {
        printf("Error %u: %s\n", mysql_errno(mysql), mysql_error(mysql));
		getch();
        exit(1);
    }
	   if (mysql_real_connect(mysql, "127.0.0.1", "root", "", "ssd", 0, NULL, 0) == NULL) {
        printf("Error %u: %s\n", mysql_errno(mysql), mysql_error(mysql));
		getch();
        exit(1);
    }
	mysql_query(mysql, "SET NAMES 'big5'");
     while (std::getline(fin,readIn)){
		 char * C_lineString = Utf2ANSI(readIn.c_str());
	     string lineString(C_lineString); 
		 takeToken(lineString);
		// cout << lineString << endl;
	 }

    mysql_close(mysql);

	 getch();
     return 0;
}